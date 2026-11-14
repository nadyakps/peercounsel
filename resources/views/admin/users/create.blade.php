@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('page-heading', 'Tambah Pengguna')

@section('content')

<div class="max-w-3xl">

    <div class="mb-8">
        <h1 class="text-2xl font-bold">Tambah Pengguna</h1>
        <p class="text-slate-500 mt-2">
            Masukkan informasi untuk membuat akun pengguna baru.
        </p>
    </div>

    <div class="bg-white p-8 rounded-xl border border-slate-200">

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="space-y-5">

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nama Lengkap
                    </label>

                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Password
                    </label>

                    <input type="password" name="password"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Konfirmasi Password
                    </label>

                    <input type="password" name="password_confirmation"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Role Pengguna
                    </label>

                    <select name="role" required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                        <option value="">Pilih Role</option>

                        <option value="konseli"
                            @selected(old('role') === 'konseli')>
                            Konseli
                        </option>

                        <option value="konselor"
                            @selected(old('role') === 'konselor')>
                            Konselor
                        </option>

                    </select>

                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('admin.users.index') }}"
                    class="px-5 py-3 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200">
                    Batal
                </a>

                <button type="submit"
                    class="px-5 py-3 rounded-lg bg-teal-600 text-white hover:bg-teal-700">
                    Simpan Pengguna
                </button>

            </div>

        </form>

    </div>

</div>

@endsection