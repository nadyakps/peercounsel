<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    // Menampilkan percakapan milik konselor
    public function show($id)
    {
        $conversation = Conversation::with([
            'counselingRequest.konseli',
            'messages'
        ])
        ->whereHas('counselingRequest', function ($query) {
            $query->where('konselor_id', auth()->id())
                  ->where('status', 'accepted');
        })
        ->findOrFail($id);

        return view('konselor.chat.show', compact('conversation'));
    }

    // Mengirim pesan dari konselor
    public function store(Request $request, $id)
    {
        $conversation = Conversation::whereHas(
            'counselingRequest',
            function ($query) {
                $query->where('konselor_id', auth()->id())
                      ->where('status', 'accepted');
            }
        )->findOrFail($id);

        if ($conversation->status !== 'active') {
            return back()->with(
                'error',
                'Percakapan ini sudah ditutup.'
            );
        }

        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        DB::transaction(function () use ($conversation, $validated) {

            // Alihkan percakapan dari AI ke konselor
            if ($conversation->active_mode === 'ai') {
                $conversation->update([
                    'active_mode' => 'counselor',
                ]);
            }

            // Simpan pesan konselor
            $conversation->messages()->create([
                'sender_id' => auth()->id(),
                'sender_type' => 'konselor',
                'message' => $validated['message'],
            ]);
        });

        return redirect()
            ->route('konselor.chat.show', $conversation->id);
    }
    
    // Mengakhiri sesi konseling
    public function end($id)
    {
        $conversation = Conversation::whereHas(
            'counselingRequest',
            function ($query) {
                $query->where('konselor_id', auth()->id())
                    ->where('status', 'accepted');
            }
        )->findOrFail($id);

        if ($conversation->status === 'closed') {
            return redirect()
                ->route('konselor.dashboard')
                ->with('error', 'Sesi konseling ini sudah selesai.');
        }

        $conversation->update([
            'status' => 'closed',
        ]);

        return redirect()
            ->route('konselor.dashboard')
            ->with('success', 'Sesi konseling berhasil diakhiri.');
    }
}
