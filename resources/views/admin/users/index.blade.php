
@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('page-heading', 'Manajemen Pengguna')

@section('content')

<div class="space-y-6">

    {{-- Header Halaman --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Manajemen Pengguna
        </h1>

        <p class="text-slate-500 mt-2">
            Kelola akun konseli dan konselor yang terdaftar pada platform.
        </p>
    </div>

    {{-- Notifikasi Berhasil --}}
    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ringkasan Pengguna --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div class="bg-white p-6 rounded-xl border border-slate-200">
            <p class="text-sm text-slate-500">
                Total Konseli
            </p>

            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                {{ \App\Models\User::where('role', 'konseli')->count() }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl border border-slate-200">
            <p class="text-sm text-slate-500">
                Total Konselor
            </p>

            <h2 class="text-3xl font-bold text-slate-800 mt-2">
                {{ \App\Models\User::where('role', 'konselor')->count() }}
            </h2>
        </div>

    </div>

    {{-- Tombol Tambah Pengguna --}}
    <div>
        <a href="{{ route('admin.users.create') }}"
            class="inline-block bg-teal-600 text-white px-5 py-3 rounded-lg hover:bg-teal-700 transition">
            + Tambah Pengguna
        </a>
    </div>

    {{-- Pencarian dan Filter --}}
    <div class="bg-white p-5 rounded-xl border border-slate-200">

        <form method="GET" action="{{ route('admin.users.index') }}"
            class="flex flex-col md:flex-row gap-3">

            {{-- Pencarian --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email pengguna..."
                class="flex-1 rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

            {{-- Filter Role --}}
            <select
                name="role"
                class="rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                <option value="">Semua Role</option>

                <option value="konseli"
                    {{ request('role') == 'konseli' ? 'selected' : '' }}>
                    Konseli
                </option>

                <option value="konselor"
                    {{ request('role') == 'konselor' ? 'selected' : '' }}>
                    Konselor
                </option>

            </select>

            {{-- Tombol Cari --}}
            <button type="submit"
                class="bg-teal-600 text-white px-5 py-2 rounded-lg hover:bg-teal-700 transition">
                Cari
            </button>

            {{-- Tombol Reset --}}
            <a href="{{ route('admin.users.index') }}"
                class="bg-slate-100 text-slate-600 px-5 py-2 rounded-lg hover:bg-slate-200 text-center transition">
                Reset
            </a>

        </form>

    </div>

    {{-- Tabel Pengguna --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        <div class="p-5 border-b border-slate-200">
            <h2 class="font-semibold text-slate-800">
                Daftar Pengguna
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                {{-- Header Tabel --}}
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Bergabung</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Akun</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>

                {{-- Isi Tabel --}}
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $users->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $user->role === 'konseli'
                                        ? 'bg-blue-100 text-blue-700'
                                        : 'bg-purple-100 text-purple-700' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            {{-- Status Akun --}}
                            <td class="px-6 py-4 text-sm">
                                @if($user->is_active)
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">

                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                    class="px-3 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form method="POST"
                                        action="{{ route('admin.users.toggle-status', $user->id) }}"
                                        onsubmit="return confirm('Yakin ingin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} akun ini?')">
                                        @csrf
                                        @method('PATCH')

                                        @if($user->is_active)
                                            <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100">
                                                Nonaktifkan
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="px-3 py-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-100">
                                                Aktifkan
                                            </button>
                                        @endif
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="p-5 border-t border-slate-200">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection
