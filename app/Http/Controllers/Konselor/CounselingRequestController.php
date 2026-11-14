<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use App\Models\CounselingRequest;
use Illuminate\Http\Request;

class CounselingRequestController extends Controller
{
    // Menampilkan daftar permintaan konseling
    public function index()
    {
        $requests = CounselingRequest::with(['konseli', 'conversation'])
            ->where('konselor_id', auth()->id())
            ->where(function ($query) {
                $query->where('status', 'pending')
                    ->orWhereHas('conversation', function ($conversationQuery) {
                        $conversationQuery->where('status', 'active');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('konselor.counseling.index', compact('requests'));
    }

    public function show($id)
    {
        $requestItem = CounselingRequest::with('konseli')
            ->where('konselor_id', auth()->id())
            ->findOrFail($id);

        return view('konselor.counseling.show', compact('requestItem'));
    }

    // Menerima permintaan konseling
    public function accept($id)
    {
        $requestItem = CounselingRequest::where('konselor_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $requestItem->update([
            'status' => 'accepted'
        ]);

        return redirect()
            ->route('konselor.counseling.show', $requestItem->id)
            ->with('success', 'Permintaan konseling berhasil diterima.');
    }


    // Menolak permintaan konseling
    public function reject($id)
    {
        $requestItem = CounselingRequest::where('konselor_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $requestItem->update([
            'status' => 'rejected'
        ]);

        return redirect()
            ->route('konselor.counseling.show', $requestItem->id)
            ->with('success', 'Permintaan konseling berhasil ditolak.');
    }

    public function history()
    {
        $history = CounselingRequest::with(['konseli', 'conversation'])
            ->where('konselor_id', auth()->id())
            ->whereHas('conversation', function ($query) {
                $query->where('status', 'closed');
            })
            ->latest()
            ->paginate(10);

        return view('konselor.counseling.history', compact('history'));
    }
}