
@extends('layouts.app')

@section('title', 'Pengajuan Konseling')
@section('page-heading', 'Pengajuan Konseling')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <h2 class="text-xl font-bold text-gray-800">
            Formulir Pengajuan Konseling
        </h2>

        <p class="text-gray-500 mt-1">
            Lengkapi informasi berikut untuk mengajukan sesi konseling.
        </p>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">

        <div class="mb-6 pb-5 border-b border-gray-200">
            <p class="text-sm text-gray-500 mb-2">
                Konselor yang dipilih
            </p>

            <h3 class="text-lg font-bold text-gray-800">
                {{ $konselor->name }}
            </h3>

            <p class="text-sm text-gray-500">
                {{ $konselor->email }}
            </p>
        </div>

        <form action="{{ route('konseli.counseling.store', $konselor->id) }}"
              method="POST">

            @csrf

            <div class="mb-5">
                <label for="topic"
                    class="block text-sm font-medium text-gray-700 mb-2">
                    Topik Konseling
                </label>

                <input
                    type="text"
                    id="topic"
                    name="topic"
                    value="{{ old('topic') }}"
                    placeholder="Contoh: Masalah akademik, keluarga, atau pertemanan"
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >

                @error('topic')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description"
                    class="block text-sm font-medium text-gray-700 mb-2">
                    Ceritakan Masalah yang Ingin Dikonsultasikan
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="6"
                    placeholder="Ceritakan situasi atau masalah yang sedang kamu hadapi..."
                    class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">

                <a href="{{ route('konseli.counseling.index') }}"
                style="display: inline-block; padding: 12px 24px; border: 1px solid #d1d5db; color: #374151; border-radius: 8px; text-decoration: none;">
                    Kembali
                </a>

                <button type="submit"
                    style="display: inline-block; padding: 12px 24px; background-color: #4f46e5; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                    Kirim Pengajuan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
