<?php

namespace App\Http\Controllers\Konseli;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CounselingRequest;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounselingRequestController extends Controller
{
    // Menampilkan daftar konselor aktif
    public function index()
    {
        $konselors = User::where('role', 'konselor')
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('konseli.counseling.index', compact('konselors'));
    }

    public function create(User $konselor)
    {
        abort_unless(
            $konselor->role === 'konselor'
            && $konselor->is_active,
            404
        );

        return view('konseli.counseling.create', compact('konselor'));
    }

    public function store(Request $request, User $konselor)
    {
        abort_unless(
            $konselor->role === 'konselor'
            && $konselor->is_active,
            404
        );

        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
        ]);

        DB::transaction(function () use ($validated, $konselor) {
            $counselingRequest = CounselingRequest::create([
                'konseli_id' => auth()->id(),
                'konselor_id' => $konselor->id,
                'topic' => $validated['topic'],
                'description' => $validated['description'],
                'status' => 'pending',
            ]);

            $counselingRequest->conversation()->create([
                'status' => 'active',
                'active_mode' => 'ai',
            ]);
        });

        return redirect()
            ->route('konseli.counseling.index')
            ->with(
                'success',
                'Pengajuan konseling berhasil dikirim. AI Companion siap menemanimu sementara menunggu konselor.'
            );
    }


    // Menampilkan seluruh riwayat pengajuan konseling
    public function history()
    {
        $requests = CounselingRequest::with([
            'konselor',
            'conversation'
        ])
            ->where('konseli_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('konseli.counseling.history', compact('requests'));
    }

    // Menampilkan detail riwayat pengajuan
    public function showHistory($id)
    {
        $requestItem = CounselingRequest::with([
            'konselor',
            'conversation'
        ])
            ->where('konseli_id', auth()->id())
            ->findOrFail($id);

        return view('konseli.counseling.show', compact('requestItem'));
    }
}
