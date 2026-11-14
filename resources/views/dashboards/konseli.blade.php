@extends('layouts.app')

@section('title', 'Dashboard Konseli')

@section('page-heading', 'Dashboard Konseli')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold">
            Halo, {{ Auth::user()->name }}!
        </h1>

        <p class="text-slate-500 mt-2">
            Selamat datang di Peer Counseling Platform.
            Temukan ruang aman untuk berbagi cerita.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500">Total Konseling</p>
            <h2 class="text-3xl font-bold mt-2">{{ $totalCounseling }}</h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500">Konseling Aktif</p>
            <h2 class="text-3xl font-bold mt-2">{{ $activeCounseling }}</h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500">Konseling Selesai</p>
            <h2 class="text-3xl font-bold mt-2">{{ $completedCounseling }}</h2>
        </div>

    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-slate-200 mt-8">
        <h2 class="text-lg font-bold mb-2">
            Butuh teman untuk bercerita?
        </h2>

        <p class="text-slate-500 mb-5">
            Mulai sesi konseling bersama konselor sebaya yang siap mendengarkan.
        </p>

        <a href="{{ route('konseli.counseling.index') }}"
            class="inline-block bg-teal-600 text-white px-5 py-3 rounded-lg hover:bg-teal-700">
                Mulai Konseling
        </a>
    </div>

@endsection