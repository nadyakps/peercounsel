
@extends('layouts.app')

@section('title', 'Pilih Konselor')
@section('page-heading', 'Pilih Konselor')

@section('content')

<div class="space-y-6">

    {{-- Header halaman --}}
    <div>
        <h2 class="text-xl font-bold text-gray-800">
            Temukan Konselor
        </h2>

        <p class="text-gray-500 mt-1">
            Pilih konselor yang ingin kamu ajak berkonsultasi.
        </p>
    </div>

    {{-- Notifikasi berhasil --}}
    @if(session('success'))
        <div style="padding: 16px; background-color: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; border-radius: 8px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi error validasi --}}
    @if($errors->any())
        <div style="padding: 16px; background-color: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; border-radius: 8px;">
            <ul style="list-style: disc; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Jika tidak ada konselor --}}
    @if($konselors->isEmpty())

        <div class="bg-white rounded-xl p-8 text-center border border-gray-200">

            <div class="text-4xl mb-3">
                👤
            </div>

            <h3 class="font-semibold text-gray-700">
                Belum Ada Konselor
            </h3>

            <p class="text-gray-500 mt-2">
                Saat ini belum ada akun konselor aktif.
                Silakan coba kembali nanti.
            </p>

        </div>

    @else

        {{-- Daftar konselor --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            @foreach($konselors as $konselor)

                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">

                    {{-- Informasi konselor --}}
                    <div class="flex items-center gap-4 mb-5">

                        {{-- Avatar --}}
                        <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center">

                            <span class="text-xl font-bold text-indigo-600">
                                {{ strtoupper(substr($konselor->name, 0, 1)) }}
                            </span>

                        </div>

                        {{-- Nama dan role --}}
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">
                                {{ $konselor->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Konselor
                            </p>
                        </div>

                    </div>

                    {{-- Email konselor --}}
                    <div class="mb-4">

                        <p class="text-sm text-gray-500 mb-1">
                            Email
                        </p>

                        <p class="text-gray-700">
                            {{ $konselor->email }}
                        </p>

                    </div>

                    {{-- Status ketersediaan --}}
                    <div class="mb-5">

                        <p class="text-sm text-gray-500 mb-2">
                            Status Ketersediaan
                        </p>

                        @if($konselor->availability_status === 'available')

                            <span style="display: inline-block; padding: 6px 12px; background-color: #dcfce7; color: #15803d; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                ● Available
                            </span>

                        @else

                            <span style="display: inline-block; padding: 6px 12px; background-color: #f1f5f9; color: #475569; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                ● Away
                            </span>

                        @endif

                    </div>

                    {{-- Tombol pengajuan --}}
                    <a
                        href="{{ route('konseli.counseling.create', $konselor->id) }}"
                        style="display: block; width: 100%; box-sizing: border-box; background-color: #4f46e5; color: #ffffff; text-align: center; padding: 12px; border-radius: 8px; font-weight: 600; text-decoration: none; cursor: pointer;"
                    >
                        Pilih Konselor
                    </a>

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection
