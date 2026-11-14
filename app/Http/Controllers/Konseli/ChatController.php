<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Services\OpenRouterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    // Menampilkan percakapan milik konseli
    public function show($id)
    {
        $conversation = Conversation::with([
            'counselingRequest.konselor',
            'messages'
        ])
        ->whereHas('counselingRequest', function ($query) {
            $query->where('konseli_id', auth()->id());
        })
        ->findOrFail($id);

        return view('konseli.chat.show', compact('conversation'));
    }

    // Menyimpan pesan konseli dan menghubungi AI Companion
    public function store(
        Request $request,
        OpenRouterService $openRouterService,
        $id
    ) {
        $conversation = Conversation::with([
            'counselingRequest.konselor'
        ])
        ->whereHas('counselingRequest', function ($query) {
            $query->where('konseli_id', auth()->id());
        })
        ->findOrFail($id);

        if ($conversation->status !== 'active') {
            return back()->with(
                'error',
                'Percakapan ini sudah ditutup.'
            );
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $counselingRequest = $conversation->counselingRequest;
        $konselor = $counselingRequest->konselor;

        if ($counselingRequest->status === 'rejected') {
            return back()->with(
                'error',
                'Pengajuan konseling ini telah ditolak.'
            );
        }

        // Tentukan pihak yang menangani percakapan
        $aiActive = (
            $counselingRequest->status === 'pending'
            || $konselor->availability_status === 'away'
        );

        $conversation->update([
            'active_mode' => $aiActive ? 'ai' : 'counselor',
        ]);

        // Simpan pesan konseli
        $conversation->messages()->create([
            'sender_id' => auth()->id(),
            'sender_type' => 'konseli',
            'message' => $validated['message'],
        ]);

        // Hubungi OpenRouter jika AI sedang aktif
        if ($aiActive) {
            try {
                $reply = $openRouterService->generateReply(
                    $conversation
                );

                // Simpan balasan AI
                $conversation->messages()->create([
                    'sender_id' => null,
                    'sender_type' => 'ai',
                    'message' => $reply,
                ]);

            } catch (\Throwable $e) {
                Log::error('OpenRouter gagal memproses pesan.', [
                    'conversation_id' => $conversation->id,
                    'error' => $e->getMessage(),
                ]);

                return back()->with(
                    'error',
                    'AI Companion sedang tidak dapat dihubungi. Silakan coba lagi.'
                );
            }
        }

        return redirect()->route(
            'konseli.chat.show',
            $conversation->id
        );
    }
}
