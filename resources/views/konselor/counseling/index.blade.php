
@extends('layouts.app')

@section('title', 'Permintaan Konseling')
@section('page-heading', 'Permintaan Konseling')

@section('content')

<div style="max-width: 1100px; margin: auto;">

    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 22px; font-weight: 700; color: #1e293b;">
            Daftar Permintaan Konseling
        </h2>
        <p style="color: #64748b; margin-top: 6px;">
            Lihat dan kelola permintaan konseling yang masuk.
        </p>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 14px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

        @if($requests->count() > 0)

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">

                    <thead>
                        <tr style="background: #f8fafc; color: #475569;">
                            <th style="padding: 14px;">Nama Konseli</th>
                            <th style="padding: 14px;">Topik</th>
                            <th style="padding: 14px;">Tanggal Pengajuan</th>
                            <th style="padding: 14px;">Status</th>
                            <th style="padding: 14px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($requests as $requestItem)

                            <tr style="border-top: 1px solid #e2e8f0;">

                                <td style="padding: 14px; color: #334155;">
                                    {{ $requestItem->konseli->name }}
                                </td>

                                <td style="padding: 14px; color: #334155;">
                                    {{ $requestItem->topic }}
                                </td>

                                <td style="padding: 14px; color: #64748b;">
                                    {{ $requestItem->created_at->format('d M Y') }}
                                </td>

                                <td style="padding: 14px;">
                                    @if($requestItem->status === 'pending')
                                        <span style="background: #fef3c7; color: #92400e; padding: 6px 12px; border-radius: 20px; font-size: 12px;">
                                            Menunggu
                                        </span>
                                    @elseif($requestItem->status === 'accepted')
                                        <span style="background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 20px; font-size: 12px;">
                                            Diterima
                                        </span>
                                    @elseif($requestItem->status === 'rejected')
                                        <span style="background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 20px; font-size: 12px;">
                                            Ditolak
                                        </span>
                                    @else
                                        <span style="background: #e0e7ff; color: #3730a3; padding: 6px 12px; border-radius: 20px; font-size: 12px;">
                                            Selesai
                                        </span>
                                    @endif
                                </td>

                                <td style="padding: 14px;">
                                    <a href="{{ route('konselor.counseling.show', $requestItem->id) }}"
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
                    Belum Ada Permintaan Konseling
                </h3>

                <p style="color: #94a3b8; margin-top: 8px;">
                    Permintaan konseling dari Konseli akan muncul di halaman ini.
                </p>
            </div>

        @endif

    </div>

</div>

@endsection
