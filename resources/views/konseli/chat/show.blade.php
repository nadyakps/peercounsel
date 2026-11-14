
@extends('layouts.app')

@section('title', 'Chat Konseling')
@section('page-heading', 'Chat Konseling')

@section('content')

<div style="max-width: 850px; margin: auto;">

    {{-- Informasi Konselor --}}
    <div style="
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        border: 1px solid #e2e8f0;
    ">

        <div>
            <h2 style="font-size: 18px; font-weight: 700; color: #1e293b;">
                {{ $conversation->counselingRequest->konselor->name }}
            </h2>

            <p style="color: #64748b; font-size: 14px;">
                Konselor
            </p>
        </div>

        <span style="
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            background-color: {{ $conversation->active_mode === 'ai' ? '#e0e7ff' : '#dcfce7' }};
            color: {{ $conversation->active_mode === 'ai' ? '#3730a3' : '#166534' }};
        ">
            {{ $conversation->active_mode === 'ai' ? 'AI Companion Aktif' : 'Konselor Aktif' }}
        </span>

    </div>

    {{-- Notifikasi Error --}}
    @if(session('error'))
        <div style="
            padding: 12px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
            margin-bottom: 15px;
        ">
            {{ session('error') }}
        </div>
    @endif

    {{-- Area Chat --}}
    <div style="
        background: white;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
    ">

        {{-- Header Chat --}}
        <div style="
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        ">
            <h3 style="font-weight: 700; color: #1e293b;">
                Percakapan
            </h3>

            <p style="font-size: 13px; color: #64748b; margin-top: 5px;">
                Sampaikan apa yang sedang kamu rasakan.
            </p>
        </div>

        {{-- Daftar Pesan --}}
        <div style="
            padding: 20px;
            min-height: 300px;
            max-height: 450px;
            overflow-y: auto;
            background-color: #fafafa;
        ">

        
            
            @forelse($conversation->messages as $message)

            <div style="
                display: flex;
                justify-content: {{ $message->sender_type === 'konseli' ? 'flex-end' : 'flex-start' }};
                width: 100%;
                margin-bottom: 20px;
                min-width: 0;
            ">

                <div style="
                    display: flex;
                    flex-direction: column;
                    align-items: {{ $message->sender_type === 'konseli' ? 'flex-end' : 'flex-start' }};
                    width: fit-content;
                    max-width: 75%;
                    min-width: 0;
                    flex: 0 1 auto;
                ">

                    <p style="
                        font-size: 12px;
                        color: #64748b;
                        margin-bottom: 6px;
                    ">
                        @if($message->sender_type === 'konseli')
                            Kamu
                        @elseif($message->sender_type === 'ai')
                            AI Companion
                        @else
                            Konselor
                        @endif
                    </p>

                    <div style="
                        display: block;
                        width: fit-content;
                        max-width: 100%;
                        box-sizing: border-box;
                        padding: 12px 16px;
                        border-radius: 12px;
                        background-color: {{ $message->sender_type === 'konseli' ? '#4f46e5' : '#f1f5f9' }};
                        color: {{ $message->sender_type === 'konseli' ? '#ffffff' : '#1e293b' }};
                        font-size: 14px;
                        line-height: 1.6;
                        text-align: left !important;
                        white-space: pre-wrap;
                        overflow-wrap: anywhere;
                    ">{{ $message->message }}</div>

                    <p style="
                        font-size: 11px;
                        color: #94a3b8;
                        margin-top: 5px;
                    ">
                        {{ $message->created_at->format('H:i') }}
                    </p>

                </div>

            </div>

        @empty

            <div style="text-align: center; padding: 60px 20px;">
                <div style="font-size: 36px;">💬</div>

                <p style="font-weight: 600; color: #334155; margin-top: 10px;">
                    Belum Ada Pesan
                </p>

                <p style="font-size: 13px; color: #64748b;">
                    Mulai percakapan dengan mengirim pesan pertama.
                </p>
            </div>

        @endforelse

        </div>

        {{-- Form Kirim Pesan --}}
        @if($conversation->status === 'active')

            <div style="
                padding: 20px;
                border-top: 1px solid #e2e8f0;
                background-color: white;
            ">

                <form
                    action="{{ route('konseli.chat.store', $conversation->id) }}"
                    method="POST"
                    style="
                        display: flex;
                        gap: 10px;
                        align-items: flex-end;
                    "
                >
                    @csrf

                    <textarea
                        name="message"
                        placeholder="Tulis pesanmu di sini..."
                        required
                        maxlength="5000"
                        rows="1"
                        style="
                            flex: 1;
                            min-width: 0;
                            min-height: 48px;
                            max-height: 120px;
                            resize: vertical;
                            padding: 12px;
                            border: 1px solid #cbd5e1;
                            border-radius: 8px;
                            outline: none;
                            color: #1e293b;
                            background-color: white;
                            font-family: inherit;
                            font-size: 14px;
                            line-height: 1.5;
                        "
                    >{{ old('message') }}</textarea>

                    <button
                        type="submit"
                        style="
                            background-color: #4f46e5;
                            color: #ffffff;
                            padding: 12px 20px;
                            min-height: 48px;
                            border: none;
                            border-radius: 8px;
                            font-weight: 600;
                            cursor: pointer;
                            flex-shrink: 0;
                        "
                    >
                        Kirim
                    </button>

                </form>

                @error('message')
                    <p style="color: #dc2626; font-size: 13px; margin-top: 8px;">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        @else

            <div style="
                padding: 20px;
                text-align: center;
                color: #64748b;
                border-top: 1px solid #e2e8f0;
            ">
                Percakapan ini sudah ditutup.
            </div>

        @endif

    </div>

    {{-- Informasi AI Companion --}}
    @if($conversation->active_mode === 'ai')

        <div style="
            background: #eef2ff;
            color: #3730a3;
            padding: 16px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 13px;
            line-height: 1.6;
        ">
            <strong>AI Companion:</strong>

            Aku adalah teman curhat berbasis AI yang dapat menemanimu sementara.
            Aku bukan psikolog dan tidak dapat memberikan diagnosis profesional.
            Percakapan ini dapat dibaca oleh konselormu.
        </div>

    @endif

</div>

@endsection
