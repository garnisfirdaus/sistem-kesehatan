<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use App\Models\RiwayatPrediksi;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    /**
     * Show the form for creating a new prediction.
     */
    public function create()
    {
        return view('prediksi.create');
    }

    /**
     * Store a newly created prediction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'gaya_hidup' => 'required|string|max:255',
            'riwayat_penyakit' => 'required|string|max:255',
        ]);

        // Get training data
        $trainingData = DataTraining::all();
        
        // Perform Naive Bayes prediction
        $hasilPrediksi = $this->naiveBayesPrediction(
            $request->umur,
            $request->gaya_hidup,
            $request->riwayat_penyakit,
            $trainingData
        );
        
        // Store prediction result
        $riwayatPrediksi = RiwayatPrediksi::create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'gaya_hidup' => $request->gaya_hidup,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'hasil_prediksi' => $hasilPrediksi['prediction'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('riwayat.show', $riwayatPrediksi->id)
            ->with('success', 'Prediksi berhasil dibuat.')
            ->with('probabilitas', $hasilPrediksi['probabilities']);
    }

    /**
     * Naive Bayes prediction algorithm
     */
    private function naiveBayesPrediction($umur, $gayaHidup, $riwayatPenyakit, $trainingData)
    {
        // Count total records
        $totalRecords = $trainingData->count();
        
        if ($totalRecords === 0) {
            return [
                'prediction' => 'Tidak dapat melakukan prediksi (data training kosong)',
                'probabilities' => []
            ];
        }

        // Get unique classes (status kesehatan)
        $classes = $trainingData->pluck('status_kesehatan')->unique();
        
        // Calculate prior probabilities P(C)
        $classCounts = [];
        $priorProbabilities = [];
        
        foreach ($classes as $class) {
            $count = $trainingData->where('status_kesehatan', $class)->count();
            $classCounts[$class] = $count;
            $priorProbabilities[$class] = $count / $totalRecords;
        }
        
        // Calculate conditional probabilities for each feature
        $posteriorProbabilities = [];
        $smoothingFactor = 1; // Laplace smoothing
        
        foreach ($classes as $class) {
            $classData = $trainingData->where('status_kesehatan', $class);
            $classCount = $classCounts[$class];
            
            // Age feature (discretize age)
            $ageCategory = $this->categorizeAge($umur);
            $ageCount = $classData->filter(function ($item) use ($ageCategory) {
                return $this->categorizeAge($item->umur) === $ageCategory;
            })->count();
            
            // Apply Laplace smoothing
            $pAge = ($ageCount + $smoothingFactor) / ($classCount + $smoothingFactor * 3); // 3 age categories
            
            // Lifestyle feature
            $lifestyleCount = $classData->where('gaya_hidup', $gayaHidup)->count();
            $uniqueLifestyles = $trainingData->pluck('gaya_hidup')->unique()->count();
            $pLifestyle = ($lifestyleCount + $smoothingFactor) / ($classCount + $smoothingFactor * $uniqueLifestyles);
            
            // Medical history feature
            $medicalHistoryCount = $classData->where('riwayat_penyakit', $riwayatPenyakit)->count();
            $uniqueMedicalHistories = $trainingData->pluck('riwayat_penyakit')->unique()->count();
            $pMedicalHistory = ($medicalHistoryCount + $smoothingFactor) / ($classCount + $smoothingFactor * $uniqueMedicalHistories);
            
            // Calculate posterior probability P(C|X) ∝ P(C) * P(X1|C) * P(X2|C) * P(X3|C)
            $posteriorProbabilities[$class] = $priorProbabilities[$class] * $pAge * $pLifestyle * $pMedicalHistory;
        }
        
        // Find the class with the highest probability
        $maxProbability = 0;
        $predictedClass = '';
        
        foreach ($posteriorProbabilities as $class => $probability) {
            if ($probability > $maxProbability) {
                $maxProbability = $probability;
                $predictedClass = $class;
            }
        }
        
        // Normalize probabilities to sum to 1
        $sum = array_sum($posteriorProbabilities);
        $normalizedProbabilities = [];
        
        foreach ($posteriorProbabilities as $class => $probability) {
            $normalizedProbabilities[$class] = round(($probability / $sum) * 100, 2);
        }
        
        return [
            'prediction' => $predictedClass,
            'probabilities' => $normalizedProbabilities
        ];
    }
    
    /**
     * Categorize age into discrete groups for Naive Bayes
     */
    private function categorizeAge($age)
    {
        if ($age < 30) {
            return 'young';
        } elseif ($age < 50) {
            return 'middle';
        } else {
            return 'senior';
        }
    }
}
