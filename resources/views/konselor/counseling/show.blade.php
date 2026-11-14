
@extends('layouts.app')

@section('title', 'Detail Permintaan Konseling')
@section('page-heading', 'Detail Permintaan Konseling')

@section('content')

<div style="max-width: 850px; margin: auto;">

    <div style="margin-bottom: 24px;">
        <h2 style="font-size: 22px; font-weight: 700; color: #1e293b;">
            Detail Pengajuan Konseling
        </h2>
        <p style="color: #64748b; margin-top: 6px;">
            Informasi lengkap mengenai permintaan konseling dari Konseli.
        </p>
    </div>

    <div style="background: white; border-radius: 12px; padding: 28px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

        @if(session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 14px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 6px;">
                Nama Konseli
            </p>
            <p style="font-size: 16px; font-weight: 600; color: #334155;">
                {{ $requestItem->konseli->name }}
            </p>
        </div>

        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 6px;">
                Email Konseli
            </p>
            <p style="font-size: 16px; color: #334155;">
                {{ $requestItem->konseli->email }}
            </p>
        </div>

        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 6px;">
                Topik Konseling
            </p>
            <p style="font-size: 16px; font-weight: 600; color: #334155;">
                {{ $requestItem->topic }}
            </p>
        </div>

        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 6px;">
                Deskripsi Permasalahan
            </p>
            <div style="background: #f8fafc; padding: 16px; border-radius: 8px; color: #334155; line-height: 1.7;">
                {{ $requestItem->description }}
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 6px;">
                Tanggal Pengajuan
            </p>
            <p style="font-size: 16px; color: #334155;">
                {{ $requestItem->created_at->format('d M Y, H:i') }}
            </p>
        </div>

        <div style="margin-bottom: 24px;">
            <p style="font-size: 13px; color: #94a3b8; margin-bottom: 6px;">
                Status Pengajuan
            </p>

            @if($requestItem->status === 'pending')
                <span style="background: #fef3c7; color: #92400e; padding: 7px 14px; border-radius: 20px; font-size: 13px;">
                    Menunggu
                </span>
            @elseif($requestItem->status === 'accepted')
                <span style="background: #dcfce7; color: #166534; padding: 7px 14px; border-radius: 20px; font-size: 13px;">
                    Diterima
                </span>
            @elseif($requestItem->status === 'rejected')
                <span style="background: #fee2e2; color: #991b1b; padding: 7px 14px; border-radius: 20px; font-size: 13px;">
                    Ditolak
                </span>
            @else
                <span style="background: #e0e7ff; color: #3730a3; padding: 7px 14px; border-radius: 20px; font-size: 13px;">
                    Selesai
                </span>
            @endif
        </div>

        <div style="border-top: 1px solid #e2e8f0; padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">

            <a href="{{ route('konselor.counseling.index') }}"
               style="padding: 11px 22px; border: 1px solid #d1d5db; color: #475569; border-radius: 8px; text-decoration: none;">
                Kembali
            </a>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">

                @if($requestItem->status === 'pending')

                    <form action="{{ route('konselor.counseling.reject', $requestItem->id) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                            onclick="return confirm('Apakah kamu yakin ingin menolak permintaan konseling ini?')"
                            style="padding: 11px 22px; background: #fee2e2; color: #b91c1c; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Tolak
                        </button>
                    </form>

                    <form action="{{ route('konselor.counseling.accept', $requestItem->id) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                            onclick="return confirm('Apakah kamu yakin ingin menerima permintaan konseling ini?')"
                            style="padding: 11px 22px; background: #4f46e5; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Terima
                        </button>
                    </form>

                @elseif($requestItem->status === 'accepted' && $requestItem->conversation)

                    <a href="{{ route('konselor.chat.show', $requestItem->conversation->id) }}"
                       style="padding: 11px 22px; background: #2563eb; color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                        Buka Percakapan
                    </a>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
