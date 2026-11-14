
@extends('layouts.app')

@section('title', 'Riwayat Konseling')
@section('page-heading', 'Riwayat Konseling')

@section('content')

<div style="max-width: 1100px; margin: auto;">

    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 22px; font-weight: 700; color: #1e293b;">
            Riwayat Pengajuan Konseling
        </h2>
        <p style="color: #64748b; margin-top: 6px;">
            Pantau perkembangan permintaan konseling yang telah kamu ajukan.
        </p>
    </div>

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

        @if($requests->count() > 0)

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">

                    <thead>
                        <tr style="background: #f8fafc; color: #475569;">
                            <th style="padding: 14px;">Nama Konselor</th>
                            <th style="padding: 14px;">Topik</th>
                            <th style="padding: 14px;">Tanggal Pengajuan</th>
                            <th style="padding: 14px;">Status</th>
                            <th style="padding: 14px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($requests as $requestItem)

                            @php
                                if (
                                    $requestItem->conversation &&
                                    $requestItem->conversation->status === 'closed'
                                ) {
                                    $displayStatus = 'Selesai';
                                    $statusBackground = '#dcfce7';
                                    $statusColor = '#166534';

                                } elseif ($requestItem->status === 'pending') {
                                    $displayStatus = 'Menunggu';
                                    $statusBackground = '#fef3c7';
                                    $statusColor = '#92400e';

                                } elseif ($requestItem->status === 'accepted') {
                                    $displayStatus = 'Diterima';
                                    $statusBackground = '#dcfce7';
                                    $statusColor = '#166534';

                                } elseif ($requestItem->status === 'rejected') {
                                    $displayStatus = 'Ditolak';
                                    $statusBackground = '#fee2e2';
                                    $statusColor = '#991b1b';

                                } else {
                                    $displayStatus = 'Menunggu';
                                    $statusBackground = '#fef3c7';
                                    $statusColor = '#92400e';
                                }
                            @endphp

                            <tr style="border-top: 1px solid #e2e8f0;">

                                <td style="padding: 14px; color: #334155;">
                                    {{ $requestItem->konselor->name }}
                                </td>

                                <td style="padding: 14px; color: #334155;">
                                    {{ $requestItem->topic }}
                                </td>

                                <td style="padding: 14px; color: #64748b;">
                                    {{ $requestItem->created_at->format('d M Y') }}
                                </td>

                                <td style="padding: 14px;">
                                    <span style="
                                        background: {{ $statusBackground }};
                                        color: {{ $statusColor }};
                                        padding: 6px 12px;
                                        border-radius: 20px;
                                        font-size: 12px;
                                        font-weight: 600;
                                    ">
                                        {{ $displayStatus }}
                                    </span>
                                </td>

                                <td style="padding: 14px;">
                                    <a href="{{ route('konseli.counseling.history.show', $requestItem->id) }}"
                                       style="background: #4f46e5; color: white; padding: 8px 14px; border-radius: 6px; text-decoration: none; font-size: 13px;">
                                        Lihat Detail
                                    </a>
                                </td>

                            </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $requests->links() }}
            </div>

        @else

            <div style="text-align: center; padding: 50px 20px;">
                <h3 style="font-size: 18px; font-weight: 600; color: #334155;">
                    Belum Ada Riwayat Konseling
                </h3>

                <p style="color: #94a3b8; margin-top: 8px;">
                    Pengajuan konseling yang kamu buat akan muncul di halaman ini.
                </p>

                <a href="{{ route('konseli.counseling.index') }}"
                   style="display: inline-block; margin-top: 20px; background: #4f46e5; color: white; padding: 11px 20px; border-radius: 8px; text-decoration: none;">
                    Mulai Konseling
                </a>
            </div>

        @endif

    </div>

</div>

@endsection
