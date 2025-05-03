@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="p-6 lg:p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Data Training -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Data Training</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $totalDataTraining }}</h2>
                    </div>
                </div>
            </div>

            <!-- Total Prediksi -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-50 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Prediksi</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $totalPrediksi }}</h2>
                    </div>
                </div>
            </div>

            <!-- Prediksi Terbaru -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 transition-all hover:shadow-md">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-50 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Prediksi Terbaru</p>
                        @if ($prediksiTerbaru)
                            <h2 class="text-lg font-semibold text-gray-800">{{ $prediksiTerbaru->mahasiswa->nama ?? 'Tidak diketahui' }}</h2>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $prediksiTerbaru->hasil_prediksi == 'Sehat' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $prediksiTerbaru->hasil_prediksi }}
                            </span>
                        @else
                            <p class="text-gray-500">Belum ada prediksi</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Menu Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Data Training Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-neutral-200 transition-all hover:shadow-md">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-blue-50 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Data Training</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Kelola data training untuk model prediksi kesehatan</p>
                    <div class="flex space-x-3">
                        <a href="{{ route('data-training.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Lihat Data
                        </a>
                        <a href="{{ route('data-training.create') }}" class="inline-flex items-center px-5 py-2 border border-transparent rounded-md text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Prediksi Card -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 transition-all hover:shadow-md">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-full bg-green-50 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Prediksi Kesehatan</h3>
                    </div>
                    <p class="text-gray-600 mb-6">Buat prediksi kesehatan berdasarkan data yang tersedia</p>
                    <div class="flex space-x-3">
                        <a href="{{ route('prediksi.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Buat Prediksi
                        </a>
                        <a href="{{ route('riwayat.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Riwayat Prediksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


