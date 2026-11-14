
@extends('layouts.app')

@section('title', 'Dashboard Konselor')
@section('page-heading', 'Dashboard Konselor')

@section('content')

    {{-- NOTIFIKASI --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    {{-- WELCOME --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-[#39344E]">
            Halo, {{ Auth::user()->name }}!
        </h1>

        <p class="text-sm text-[#89869A] mt-2">
            Selamat datang kembali. Siap membantu konseli hari ini?
        </p>
    </div>

    {{-- STATUS KETERSEDIAAN --}}
    <div class="bg-white p-6 rounded-2xl border border-[#ECE9F5] shadow-sm mb-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">

            <div>
                <h2 class="text-lg font-bold text-[#39344E]">
                    Status Ketersediaan
                </h2>

                <p class="text-sm text-[#89869A] mt-1">
                    Atur status untuk menentukan apakah kamu siap menerima konseli.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">

                {{-- AVAILABLE --}}
                <form action="{{ route('konselor.availability.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="availability_status" value="available">

                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold transition
                        {{ Auth::user()->availability_status === 'available'
                            ? 'bg-green-600 text-white shadow-sm'
                            : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
                        ● Available
                    </button>
                </form>

                {{-- AWAY --}}
                <form action="{{ route('konselor.availability.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="availability_status" value="away">

                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl text-sm font-semibold transition
                        {{ Auth::user()->availability_status === 'away'
                            ? 'bg-slate-600 text-white shadow-sm'
                            : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        ● Away
                    </button>
                </form>

            </div>
        </div>

        <div class="mt-5 pt-5 border-t border-[#F0EDF6]">

            @if (Auth::user()->availability_status === 'available')
                <div class="flex items-center gap-2 text-sm text-green-700">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                    <span class="font-semibold">Kamu sedang Available</span>
                    <span class="text-[#89869A]">— Siap menerima permintaan konseling.</span>
                </div>
            @else
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                    <span class="font-semibold">Kamu sedang Away</span>
                    <span class="text-[#89869A]">— AI Companion akan membantu konseli sementara.</span>
                </div>
            @endif

        </div>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 w-full">

        {{-- TOTAL PERMINTAAN --}}
        <div class="min-w-0 bg-white p-5 rounded-2xl border border-[#ECE9F5] shadow-sm">
            <p class="text-sm text-[#89869A]">Total Permintaan</p>
            <h2 class="text-3xl font-bold text-[#39344E] mt-3">
                {{ $totalRequests }}
            </h2>
            <p class="text-xs text-[#A09CAF] mt-2">Seluruh permintaan masuk</p>
        </div>

        {{-- MENUNGGU RESPONS --}}
        <div class="min-w-0 bg-white p-5 rounded-2xl border border-[#ECE9F5] shadow-sm">
            <p class="text-sm text-[#89869A]">Menunggu Respons</p>
            <h2 class="text-3xl font-bold text-amber-600 mt-3">
                {{ $pendingRequests }}
            </h2>
            <p class="text-xs text-[#A09CAF] mt-2">Permintaan belum diproses</p>
        </div>

        {{-- KONSELING AKTIF --}}
        <div class="min-w-0 bg-white p-5 rounded-2xl border border-[#ECE9F5] shadow-sm">
            <p class="text-sm text-[#89869A]">Konseling Aktif</p>
            <h2 class="text-3xl font-bold text-[#6B5BC7] mt-3">
                {{ $activeCounseling }}
            </h2>
            <p class="text-xs text-[#A09CAF] mt-2">Sesi sedang berlangsung</p>
        </div>

        {{-- KONSELING SELESAI --}}
        <div class="min-w-0 bg-white p-5 rounded-2xl border border-[#ECE9F5] shadow-sm">
            <p class="text-sm text-[#89869A]">Konseling Selesai</p>
            <h2 class="text-3xl font-bold text-green-600 mt-3">
                {{ $completedCounseling }}
            </h2>
            <p class="text-xs text-[#A09CAF] mt-2">Sesi yang telah ditutup</p>
        </div>

    </div>

    {{-- PERMINTAAN TERBARU --}}
    <div class="bg-white rounded-2xl border border-[#ECE9F5] shadow-sm mb-8">

        <div class="p-6 border-b border-[#F0EDF6] flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold text-[#39344E]">
                    Permintaan Konseling Terbaru
                </h2>

                <p class="text-sm text-[#89869A] mt-1">
                    Permintaan konseling yang masih menunggu respons.
                </p>
            </div>

            <a href="{{ route('konselor.counseling.index') }}"
               class="text-sm font-semibold text-[#6B5BC7] hover:underline">
                Lihat Semua →
            </a>
        </div>

        @forelse ($latestRequests as $item)

            <div class="p-6 border-b border-[#F5F3F9] last:border-0 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                <div>
                    <h3 class="font-semibold text-[#39344E]">
                        {{ $item->konseli->name }}
                    </h3>

                    <p class="text-sm text-[#89869A] mt-1">
                        {{ $item->topic }}
                    </p>

                    <p class="text-xs text-[#A09CAF] mt-2">
                        {{ $item->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <span class="px-3 py-1.5 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">
                        Menunggu
                    </span>

                    <a href="{{ route('konselor.counseling.show', $item->id) }}"
                       class="px-4 py-2 rounded-lg bg-[#F0EDFF] text-[#6B5BC7] text-sm font-semibold hover:bg-[#E5E0FF] transition">
                        Lihat Detail
                    </a>

                </div>

            </div>

        @empty

            <div class="p-10 text-center">
                <div class="text-4xl mb-3">📩</div>

                <h3 class="font-semibold text-[#39344E]">
                    Belum Ada Permintaan
                </h3>

                <p class="text-sm text-[#89869A] mt-2">
                    Permintaan konseling yang masuk akan ditampilkan di sini.
                </p>
            </div>

        @endforelse

    </div>

    {{-- RIWAYAT KONSELING TERBARU --}}
    <div class="bg-white rounded-2xl border border-[#ECE9F5] shadow-sm">

        <div class="p-6 border-b border-[#F0EDF6] flex flex-col sm:flex-row sm:items-center justify-between gap-3">

            <div>
                <h2 class="text-lg font-bold text-[#39344E]">
                    Riwayat Konseling
                </h2>

                <p class="text-sm text-[#89869A] mt-1">
                    Lima sesi konseling terakhir yang telah selesai.
                </p>
            </div>

            <a href="{{ route('konselor.counseling.history') }}"
               class="text-sm font-semibold text-[#6B5BC7] hover:underline">
                Lihat Semua →
            </a>

        </div>

        @forelse ($latestHistory as $item)

            <div class="p-6 border-b border-[#F5F3F9] last:border-0 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                <div>
                    <h3 class="font-semibold text-[#39344E]">
                        {{ $item->konseli->name }}
                    </h3>

                    <p class="text-sm text-[#89869A] mt-1">
                        {{ $item->topic }}
                    </p>

                    <p class="text-xs text-[#A09CAF] mt-2">
                        {{ $item->updated_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <span class="px-3 py-1.5 rounded-full bg-green-50 text-green-700 text-xs font-semibold">
                    Selesai
                </span>

            </div>

        @empty

            <div class="p-10 text-center">
                <div class="text-4xl mb-3">📋</div>

                <h3 class="font-semibold text-[#39344E]">
                    Belum Ada Riwayat
                </h3>

                <p class="text-sm text-[#89869A] mt-2">
                    Riwayat konseling akan muncul setelah sesi ditutup.
                </p>
            </div>

        @endforelse

    </div>

@endsection
