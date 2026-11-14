<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounselingRequest;
use Illuminate\Http\Request;

class CounselingMonitoringController extends Controller
{
    // Menampilkan seluruh data pengajuan konseling
    public function index(Request $request)
    {
        $query = CounselingRequest::with(['konseli', 'konselor'])
            ->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama Konseli atau Konselor
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($subQuery) use ($search) {

                $subQuery->whereHas('konseli', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('konselor', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });

            });
        }

        $requests = $query->paginate(10)->withQueryString();

        // Menghitung jumlah pengajuan berdasarkan status
        $totalRequests = CounselingRequest::count();
        $pendingRequests = CounselingRequest::where('status', 'pending')->count();
        $acceptedRequests = CounselingRequest::where('status', 'accepted')->count();
        $rejectedRequests = CounselingRequest::where('status', 'rejected')->count();
        $completedRequests = CounselingRequest::where('status', 'completed')->count();

        return view('admin.counseling.index', compact(
            'requests',
            'totalRequests',
            'pendingRequests',
            'acceptedRequests',
            'rejectedRequests',
            'completedRequests'
        ));
    }

    public function show($id)
    {
        $requestItem = CounselingRequest::with(['konseli', 'konselor'])
            ->findOrFail($id);

        return view('admin.counseling.show', compact('requestItem'));
    }
}
