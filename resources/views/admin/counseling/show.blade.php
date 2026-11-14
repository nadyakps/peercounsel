@extends('layouts.app')

@section('title', 'Detail Permintaan Konseling')
@section('page-heading', 'Detail Permintaan Konseling')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    <div class="bg-white rounded-xl shadow-sm p-6">

        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-3">
                Informasi Permintaan Konseling
            </h2>

            <a href="{{ route('admin.counseling.index') }}"
            class="inline-block text-sm text-blue-600 hover:underline">
                ← Kembali ke Monitoring Konseling
            </a>
        </div>

        <div class="space-y-5">

            <div>
                <p class="text-sm text-gray-500">Nama Konseli</p>
                <p class="font-semibold text-gray-800">
                    {{ $requestItem->konseli->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Nama Konselor</p>
                <p class="font-semibold text-gray-800">
                    {{ $requestItem->konselor->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Topik Konseling</p>
                <p class="font-semibold text-gray-800">
                    {{ $requestItem->topic }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Deskripsi Permasalahan</p>
                <div class="bg-gray-50 rounded-lg p-4 mt-2 text-gray-700">
                    {{ $requestItem->description }}
                </div>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal Pengajuan</p>
                <p class="font-semibold text-gray-800">
                    {{ $requestItem->created_at->format('d F Y, H:i') }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Status Permintaan</p>

                @if ($requestItem->status == 'pending')
                    <span class="inline-block px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700">
                        Menunggu
                    </span>
                @elseif ($requestItem->status == 'accepted')
                    <span class="inline-block px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                        Diterima
                    </span>
                @elseif ($requestItem->status == 'rejected')
                    <span class="inline-block px-3 py-1 rounded-full text-sm bg-red-100 text-red-700">
                        Ditolak
                    </span>
                @elseif ($requestItem->status == 'completed')
                    <span class="inline-block px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                        Selesai
                    </span>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection