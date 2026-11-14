@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('page-heading', 'Dashboard Admin')

@section('content')

    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold">
            Halo, {{ Auth::user()->name }}!
        </h1>

        <p class="text-slate-500 mt-2">
            Selamat datang di halaman administrasi Peer Counseling Platform.
        </p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500">Total Konseli</p>
            <h2 class="text-3xl font-bold mt-2">0</h2>
            <p class="text-xs text-slate-400 mt-2">
                Pengguna terdaftar sebagai konseli
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500">Total Konselor</p>
            <h2 class="text-3xl font-bold mt-2">0</h2>
            <p class="text-xs text-slate-400 mt-2">
                Pengguna terdaftar sebagai konselor
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <p class="text-sm text-slate-500">Total Sesi Konseling</p>
            <h2 class="text-3xl font-bold mt-2">0</h2>
            <p class="text-xs text-slate-400 mt-2">
                Seluruh sesi konseling
            </p>
        </div>

    </div>

    <!-- User Management -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 mb-8">

        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold">
                Manajemen Pengguna
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Kelola akun konseli dan konselor yang terdaftar.
            </p>
        </div>

        <div class="p-6">

            <div class="flex flex-col md:flex-row justify-between gap-4 mb-5">

                <div>
                    <h3 class="font-semibold">Daftar Pengguna</h3>
                    <p class="text-sm text-slate-500 mt-1">
                        Pantau pengguna yang terdaftar pada platform.
                    </p>
                </div>

                <button
                    class="bg-teal-600 text-white px-5 py-2 rounded-lg hover:bg-teal-700">
                    Kelola Pengguna
                </button>

            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">

                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="p-4">Nama Pengguna</th>
                            <th class="p-4">Email</th>
                            <th class="p-4">Role</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="4"
                                class="p-8 text-center text-slate-400">
                                Data pengguna akan ditampilkan di sini.
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- Counseling Monitoring -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">

        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold">
                Monitoring Aktivitas Konseling
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Pantau aktivitas dan perkembangan sesi konseling.
            </p>
        </div>

        <div class="p-10 text-center">

            <div class="text-4xl mb-3">📊</div>

            <h3 class="font-semibold text-slate-700">
                Belum Ada Aktivitas
            </h3>

            <p class="text-sm text-slate-500 mt-2">
                Aktivitas konseling akan ditampilkan di bagian ini.
            </p>

        </div>

    </div>

@endsection