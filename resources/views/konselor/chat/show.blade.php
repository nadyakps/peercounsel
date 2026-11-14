
@extends('layouts.app')

@section('title', 'Percakapan Konseling')
@section('page-heading', 'Percakapan Konseling')

@section('content')

<div style="max-width: 900px; margin: auto;">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

        {{-- Informasi Konseli --}}
        <div style="border-bottom: 1px solid #e2e8f0; padding-bottom: 18px; margin-bottom: 20px;">

            <h2 style="font-size: 20px; font-weight: 700; color: #1e293b;">
                {{ $conversation->counselingRequest->konseli->name }}
            </h2>

            <p style="font-size: 13px; color: #64748b; margin-top: 5px;">
                Topik: {{ $conversation->counselingRequest->topic }}
            </p>

            <p style="font-size: 13px; margin-top: 8px; color: #475569;">
                Mode percakapan:
                <strong>
                    {{ $conversation->active_mode === 'ai' ? 'AI Companion' : 'Konselor' }}
                </strong>
            </p>

            <p style="font-size: 13px; margin-top: 8px;">
                Status:
                @if($conversation->status === 'active')
                    <span style="color: #16a34a; font-weight: 600;">● Aktif</span>
                @else
                    <span style="color: #64748b; font-weight: 600;">● Selesai</span>
                @endif
            </p>

        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Riwayat Pesan --}}
        <div style="background: #f8fafc; border-radius: 10px; padding: 20px; min-height: 350px; max-height: 500px; overflow-y: auto;">

            @forelse($conversation->messages as $message)

                <div style="
                    display: flex;
                    justify-content: {{ $message->sender_type === 'konselor' ? 'flex-end' : 'flex-start' }};
                    margin-bottom: 16px;
                ">

                    <div style="
                        display: flex;
                        flex-direction: column;
                        align-items: {{ $message->sender_type === 'konselor' ? 'flex-end' : 'flex-start' }};
                        max-width: 75%;
                    ">

                        <span style="font-size: 12px; color: #64748b; margin-bottom: 5px;">
                            @if($message->sender_type === 'ai')
                                AI Companion
                            @elseif($message->sender_type === 'konselor')
                                Kamu (Konselor)
                            @else
                                {{ $conversation->counselingRequest->konseli->name }}
                            @endif
                        </span>

                        <div style="
                            background: {{ $message->sender_type === 'konselor' ? '#4f46e5' : ($message->sender_type === 'ai' ? '#e0e7ff' : 'white') }};
                            color: {{ $message->sender_type === 'konselor' ? 'white' : '#334155' }};
                            padding: 12px 16px;
                            border-radius: 12px;
                            width: fit-content;
                            max-width: 100%;
                            box-sizing: border-box;
                            white-space: pre-wrap;
                            overflow-wrap: anywhere;
                            line-height: 1.6;
                        ">
                            {{ $message->message }}
                        </div>

                        <span style="font-size: 11px; color: #94a3b8; margin-top: 5px;">
                            {{ $message->created_at->format('H:i') }}
                        </span>

                    </div>

                </div>

            @empty

                <div style="text-align: center; color: #94a3b8; padding: 50px 20px;">
                    Belum ada pesan dalam percakapan ini.
                </div>

            @endforelse

        </div>

        {{-- Form Kirim Pesan --}}
        @if($conversation->status === 'active')

            <form action="{{ route('konselor.chat.store', $conversation->id) }}"
                  method="POST"
                  style="display: flex; gap: 10px; margin-top: 20px;">

                @csrf

                <textarea
                    name="message"
                    required
                    maxlength="5000"
                    placeholder="Tulis balasan untuk konseli..."
                    style="
                        flex: 1;
                        min-height: 50px;
                        max-height: 120px;
                        resize: vertical;
                        padding: 12px;
                        border: 1px solid #cbd5e1;
                        border-radius: 8px;
                        font-family: inherit;
                    "
                ></textarea>

                <button type="submit"
                    style="
                        padding: 12px 22px;
                        background: #4f46e5;
                        color: white;
                        border: none;
                        border-radius: 8px;
                        font-weight: 600;
                        cursor: pointer;
                        align-self: flex-end;
                    ">
                    Kirim
                </button>

            </form>

            {{-- Tombol Akhiri Konseling --}}
            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end;">

                <form action="{{ route('konselor.chat.end', $conversation->id) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah kamu yakin ingin mengakhiri sesi konseling ini? Setelah diakhiri, percakapan tidak dapat menerima pesan baru.');">

                    @csrf
                    @method('PATCH')

                    <button type="submit"
                        style="
                            padding: 11px 20px;
                            background: #dc2626;
                            color: white;
                            border: none;
                            border-radius: 8px;
                            font-weight: 600;
                            cursor: pointer;
                        ">
                        Akhiri Konseling
                    </button>

                </form>

            </div>

        @else

            <div style="margin-top: 20px; padding: 14px; background: #f1f5f9; border-radius: 8px; color: #64748b; text-align: center;">
                Percakapan ini sudah ditutup.
            </div>

        @endif

        {{-- Tombol Kembali --}}
        <div style="margin-top: 20px;">
            <a href="{{ route('konselor.counseling.show', $conversation->counselingRequest->id) }}"
               style="color: #64748b; text-decoration: none;">
                ← Kembali ke Detail Pengajuan
            </a>
        </div>

    </div>

</div>

@endsection
