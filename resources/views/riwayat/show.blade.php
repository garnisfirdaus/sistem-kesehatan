@extends('layouts.app')

@section('content')
<div class="py-8 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold leading-7 text-primary-900 sm:text-3xl sm:truncate">
                    Detail Prediksi Kesehatan
                </h2>
                <p class="mt-1 text-sm text-neutral-500">
                    Hasil prediksi kesehatan menggunakan metode Naive Bayes
                </p>
            </div>
            <div>
                <div class="flex space-x-2">
                    <a href="{{ route('riwayat.index') }}" class="inline-flex items-center px-4 py-2 border border-neutral-300 rounded-md shadow-sm text-sm font-medium text-neutral-700 bg-white hover:bg-neutral-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                    <form action="{{ route('riwayat.destroy', $riwayat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat prediksi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-neutral-200 mb-6">
            <div class="p-6">
                <h3 class="text-lg font-medium text-neutral-900 mb-4">Data Pasien</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-neutral-500">Nama</p>
                        <p class="mt-1 text-sm text-neutral-900">{{ $riwayat->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-500">Umur</p>
                        <p class="mt-1 text-sm text-neutral-900">{{ $riwayat->umur }} tahun</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-500">Gaya Hidup</p>
                        <p class="mt-1 text-sm text-neutral-900">{{ $riwayat->gaya_hidup }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-neutral-500">Riwayat Penyakit</p>
                        <p class="mt-1 text-sm text-neutral-900">{{ $riwayat->riwayat_penyakit }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-neutral-200">
            <div class="p-6">
                <h3 class="text-lg font-medium text-neutral-900 mb-4">Hasil Prediksi</h3>
                
                <div class="mb-6">
                    <p class="text-sm font-medium text-neutral-500">Status Kesehatan</p>
                    <div class="mt-2 flex items-center">
                        @php
                            $statusColor = 'bg-green-100 text-green-800';
                            if ($riwayat->hasil_prediksi == 'Cukup Sehat') {
                                $statusColor = 'bg-yellow-100 text-yellow-800';
                            } elseif ($riwayat->hasil_prediksi == 'Perlu Perhatian') {
                                $statusColor = 'bg-red-100 text-red-800';
                            }
                        @endphp
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusColor }}">
                            {{ $riwayat->hasil_prediksi }}
                        </span>
                    </div>
                </div>

                @if (session('probabilitas'))
                    <div>
                        <p class="text-sm font-medium text-neutral-500 mb-2">Probabilitas Hasil</p>
                        <div class="space-y-3">
                            @foreach (session('probabilitas') as $status => $probability)
                                <div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm text-neutral-700">{{ $status }}</p>
                                        <p class="text-sm font-medium text-neutral-900">{{ $probability }}%</p>
                                    </div>
                                    <div class="mt-1 w-full bg-neutral-200 rounded-full h-2">
                                        <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $probability }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-6 pt-6 border-t border-neutral-200">
                    <p class="text-sm text-neutral-500">
                        Prediksi dibuat pada {{ $riwayat->created_at->format('d M Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
