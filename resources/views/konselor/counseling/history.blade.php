
@extends('layouts.app')

@section('title', 'Riwayat Konseling')
@section('page-heading', 'Riwayat Konseling')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-bold text-[#39344E]">
            Riwayat Konseling
        </h2>

        <p class="text-sm text-[#89869A] mt-2">
            Daftar sesi konseling yang telah selesai.
        </p>
    </div>

    {{-- DAFTAR RIWAYAT --}}
    <div class="bg-white rounded-2xl border border-[#ECE9F5] shadow-sm">

        @forelse ($history as $item)

            <div class="p-6 border-b border-[#F0EDF6] last:border-0
                        flex flex-col sm:flex-row sm:items-center
                        justify-between gap-4">

                <div>
                    <h3 class="font-semibold text-[#39344E]">
                        {{ $item->konseli->name }}
                    </h3>

                    <p class="text-sm text-[#89869A] mt-1">
                        {{ $item->topic }}
                    </p>

                    <p class="text-xs text-[#A09CAF] mt-2">
                        Selesai pada:
                        {{ $item->conversation->updated_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <div>
                    <span class="px-4 py-2 rounded-full
                                 bg-green-50 text-green-700
                                 text-xs font-semibold">
                        Selesai
                    </span>
                </div>

            </div>

        @empty

            <div class="p-12 text-center">

                <div class="text-5xl mb-4">📋</div>

                <h3 class="font-semibold text-[#39344E]">
                    Belum Ada Riwayat Konseling
                </h3>

                <p class="text-sm text-[#89869A] mt-2">
                    Sesi konseling yang telah diakhiri akan muncul di halaman ini.
                </p>

            </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div>
        {{ $history->links() }}
    </div>

    {{-- KEMBALI --}}
    <div>
        <a href="{{ route('konselor.dashboard') }}"
           class="inline-flex items-center px-5 py-2.5
                  rounded-xl bg-[#F0EDFF] text-[#6B5BC7]
                  text-sm font-semibold hover:bg-[#E5E0FF]">
            ← Kembali ke Dashboard
        </a>
    </div>

</div>

@endsection
