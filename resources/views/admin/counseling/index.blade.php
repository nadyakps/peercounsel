@extends('layouts.app')

@section('title', 'Monitoring Konseling')
@section('page-heading', 'Monitoring Konseling')

@section('content')

<div class="space-y-6">

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">

        <div class="bg-white p-5 rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Total Permintaan</p>
            <h3 class="text-2xl font-bold text-gray-800">
                {{ $totalRequests }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Menunggu</p>
            <h3 class="text-2xl font-bold text-yellow-600">
                {{ $pendingRequests }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Diterima</p>
            <h3 class="text-2xl font-bold text-blue-600">
                {{ $acceptedRequests }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Ditolak</p>
            <h3 class="text-2xl font-bold text-red-600">
                {{ $rejectedRequests }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-xl shadow-sm">
            <p class="text-sm text-gray-500">Selesai</p>
            <h3 class="text-2xl font-bold text-green-600">
                {{ $completedRequests }}
            </h3>
        </div>

    </div>

    {{-- Filter dan Pencarian --}}
    <div class="bg-white p-5 rounded-xl shadow-sm">

        <form action="{{ route('admin.counseling.index') }}"
              method="GET"
              class="flex flex-col md:flex-row gap-3">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama konseli atau konselor..."
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2"
            >

            <select
                name="status"
                class="border border-gray-300 rounded-lg px-4 py-2">

                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                    Menunggu
                </option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>
                    Diterima
                </option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                    Ditolak
                </option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                    Selesai
                </option>

            </select>

            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                Cari
            </button>

            <a
                href="{{ route('admin.counseling.index') }}"
                class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg text-center hover:bg-gray-200">
                Reset
            </a>

        </form>

    </div>

    {{-- Tabel Monitoring --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">

        <div class="p-5 border-b">
            <h3 class="font-bold text-gray-800">
                Daftar Permintaan Konseling
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                Seluruh permintaan konseling dari pengguna.
            </p>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-5 py-4">No.</th>
                        <th class="px-5 py-4">Konseli</th>
                        <th class="px-5 py-4">Konselor</th>
                        <th class="px-5 py-4">Topik</th>
                        <th class="px-5 py-4">Tanggal Pengajuan</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse ($requests as $index => $item)

                        <tr class="hover:bg-gray-50">

                            <td class="px-5 py-4">
                                {{ $requests->firstItem() + $index }}
                            </td>

                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $item->konseli->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $item->konselor->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $item->topic }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td class="px-5 py-4">

                                @if ($item->status == 'pending')
                                    <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                        Menunggu
                                    </span>
                                @elseif ($item->status == 'accepted')
                                    <span class="px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                        Diterima
                                    </span>
                                @elseif ($item->status == 'rejected')
                                    <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                                        Ditolak
                                    </span>
                                @elseif ($item->status == 'completed')
                                    <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                        Selesai
                                    </span>
                                @endif

                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('admin.counseling.show', $item->id) }}"
                                class="inline-block bg-blue-600 text-white px-3 py-2 rounded-lg text-xs hover:bg-blue-700">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-gray-500">
                                Belum ada permintaan konseling.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-5">
            {{ $requests->links() }}
        </div>

    </div>

</div>

@endsection