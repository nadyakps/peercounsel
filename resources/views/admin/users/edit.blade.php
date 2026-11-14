
@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('page-heading', 'Edit Pengguna')

@section('content')

<div class="max-w-3xl">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">
            Edit Pengguna
        </h1>

        <p class="text-slate-500 mt-2">
            Perbarui informasi akun pengguna.
        </p>
    </div>

    {{-- Form Edit --}}
    <div class="bg-white p-8 rounded-xl border border-slate-200">

        <form method="POST"
            action="{{ route('admin.users.update', $user->id) }}">

            @csrf
            @method('PUT')

            <div class="space-y-5">

                {{-- Nama --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                    @error('name')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Role --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Role Pengguna
                    </label>

                    <select
                        name="role"
                        required
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                        <option value="konseli"
                            {{ old('role', $user->role) == 'konseli' ? 'selected' : '' }}>
                            Konseli
                        </option>

                        <option value="konselor"
                            {{ old('role', $user->role) == 'konselor' ? 'selected' : '' }}>
                            Konselor
                        </option>

                    </select>

                    @error('role')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">

                    <p class="text-xs text-slate-500 mt-2">
                        Password minimal 8 karakter.
                    </p>

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-medium mb-2">
                        Konfirmasi Password Baru
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Masukkan ulang password baru"
                        class="w-full rounded-lg border-slate-300 focus:border-teal-500 focus:ring-teal-500">
                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('admin.users.index') }}"
                    class="px-5 py-3 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200">
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-3 rounded-lg bg-teal-600 text-white hover:bg-teal-700">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
