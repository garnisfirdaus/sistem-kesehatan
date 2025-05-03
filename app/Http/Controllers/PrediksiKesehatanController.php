<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PrediksiKesehatanController extends Controller
{
    public function prediksi(Request $request, $mahasiswa_id)
    {
        // Ambil data mahasiswa dan gaya hidupnya
        $mahasiswa = Mahasiswa::with(['gayaHidup', 'kesehatan'])->findOrFail($mahasiswa_id);

        // Ambil data pelatihan dari database
        $data = Mahasiswa::with('gayaHidup')->get();

        // Hitung probabilitas kelas dan fitur
        $classCounts = $data->groupBy('kesehatan.status_kesehatan')->map->count();
        $totalData = $data->count();

        $featureCounts = $this->countFeatureOccurrences($data);

        // Prediksi berdasarkan data mahasiswa
        $newData = [
            'pola_makan' => $mahasiswa->gayaHidup->pola_makan,
            'olahraga' => $mahasiswa->gayaHidup->olahraga,
            'tidur' => $mahasiswa->gayaHidup->tidur,
        ];

        // Prediksi kelas kesehatan
        $prediksiKesehatan = $this->predict($newData, $classCounts, $featureCounts, $totalData);

        // Simpan hasil prediksi ke dalam tabel Prediksi
        $mahasiswa->prediksi()->create(['prediksi_kesehatan' => $prediksiKesehatan]);

        return response()->json([
            'prediksi_kesehatan' => $prediksiKesehatan
        ]);
    }

    private function countFeatureOccurrences($data)
    {
        $featureCounts = [];

        foreach ($data as $record) {
            $kelas = $record->kesehatan->status_kesehatan;

            for ($i = 0; $i < 3; $i++) {
                $featureName = ['pola_makan', 'olahraga', 'tidur'][$i];
                $featureValue = $record->gayaHidup->{$featureName};
                $featureCounts[$kelas][$featureName][$featureValue] = ($featureCounts[$kelas][$featureName][$featureValue] ?? 0) + 1;
            }
        }

        return $featureCounts;
    }

    private function predict($newData, $classCounts, $featureCounts, $totalData)
    {
        $maxProbability = -1;
        $predictedClass = '';

        foreach ($classCounts as $kelas => $count) {
            $classProb = $count / $totalData;
            $featureProb = 1.0;

            foreach ($newData as $key => $value) {
                $featureProb *= ($featureCounts[$kelas][$key][$value] ?? 0) / $count;
            }

            $totalProb = $classProb * $featureProb;

            if ($totalProb > $maxProbability) {
                $maxProbability = $totalProb;
                $predictedClass = $kelas;
            }
        }

        return $predictedClass;
    }
}
