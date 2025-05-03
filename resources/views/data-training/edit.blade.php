@extends('layouts.app')

@section('content')
<div class="py-8 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold leading-7 text-primary-900 sm:text-3xl sm:truncate">
                Edit Data Training
            </h2>
            <p class="mt-1 text-sm text-neutral-500">
                Perbarui data untuk model prediksi kesehatan
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg p-6 border border-neutral-200">
            <form action="{{ route('data-training.update', $dataTraining->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-neutral-700">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $dataTraining->nama) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-neutral-300 rounded-md" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="umur" class="block text-sm font-medium text-neutral-700">Umur</label>
                        <input type="number" name="umur" id="umur" value="{{ old('umur', $dataTraining->umur) }}" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-neutral-300 rounded-md" required>
                        @error('umur')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gaya_hidup" class="block text-sm font-medium text-neutral-700">Gaya Hidup</label>
                        <select name="gaya_hidup" id="gaya_hidup" class="mt-1 block w-full py-2 px-3 border border-neutral-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                            <option value="">Pilih Gaya Hidup</option>
                            <option value="Aktif" {{ old('gaya_hidup', $dataTraining->gaya_hidup) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Sedentary" {{ old('gaya_hidup', $dataTraining->gaya_hidup) == 'Sedentary' ? 'selected' : '' }}>Sedentary</option>
                            <option value="Kurang Aktif" {{ old('gaya_hidup', $dataTraining->gaya_hidup) == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
                            <option value="Sehat" {{ old('gaya_hidup', $dataTraining->gaya_hidup) == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                        </select>
                        @error('gaya_hidup')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="riwayat_penyakit" class="block text-sm font-medium text-neutral-700">Riwayat Penyakit</label>
                        <select name="riwayat_penyakit" id="riwayat_penyakit" class="mt-1 block w-full py-2 px-3 border border-neutral-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                            <option value="">Pilih Riwayat Penyakit</option>
                            <option value="Tidak Ada" {{ old('riwayat_penyakit', $dataTraining->riwayat_penyakit) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                            <option value="Diabetes" {{ old('riwayat_penyakit', $dataTraining->riwayat_penyakit) == 'Diabetes' ? 'selected' : '' }}>Diabetes</option>
                            <option value="Hipertensi" {{ old('riwayat_penyakit', $dataTraining->riwayat_penyakit) == 'Hipertensi' ? 'selected' : '' }}>Hipertensi</option>
                            <option value="Jantung" {{ old('riwayat_penyakit', $dataTraining->riwayat_penyakit) == 'Jantung' ? 'selected' : '' }}>Jantung</option>
                            <option value="Asma" {{ old('riwayat_penyakit', $dataTraining->riwayat_penyakit) == 'Asma' ? 'selected' : '' }}>Asma</option>
                            <option value="Penyakit Ringan" {{ old('riwayat_penyakit', $dataTraining->riwayat_penyakit) == 'Penyakit Ringan' ? 'selected' : '' }}>Penyakit Ringan</option>
                        </select>
                        @error('riwayat_penyakit')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_kesehatan" class="block text-sm font-medium text-neutral-700">Status Kesehatan</label>
                        <select name="status_kesehatan" id="status_kesehatan" class="mt-1 block w-full py-2 px-3 border border-neutral-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                            <option value="">Pilih Status Kesehatan</option>
                            <option value="Sehat" {{ old('status_kesehatan', $dataTraining->status_kesehatan) == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                            <option value="Cukup Sehat" {{ old('status_kesehatan', $dataTraining->status_kesehatan) == 'Cukup Sehat' ? 'selected' : '' }}>Cukup Sehat</option>
                            <option value="Perlu Perhatian" {{ old('status_kesehatan', $dataTraining->status_kesehatan) == 'Perlu Perhatian' ? 'selected' : '' }}>Perlu Perhatian</option>
                        </select>
                        @error('status_kesehatan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <a href="{{ route('data-training.index') }}" class="inline-flex items-center px-4 py-2 border border-neutral-300 rounded-md shadow-sm text-sm font-medium text-neutral-700 bg-white hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 mr-3">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-neutral-300 rounded-md shadow-sm text-sm font-medium text-neutral-700 bg-white hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 mr-3">
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection