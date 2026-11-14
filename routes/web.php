<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Konseli\CounselingRequestController;
use App\Http\Controllers\Konselor\CounselingRequestController as KonselorCounselingRequestController;
use App\Http\Controllers\Konselor\AvailabilityController;
use App\Http\Controllers\Konseli\ChatController;
use App\Http\Controllers\Konselor\ChatController as KonselorChatController;
use App\Models\CounselingRequest;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');


    // Dashboard Konseli
    Route::middleware(['auth', 'role:konseli'])->group(function () {

        Route::get('/konseli/dashboard', function () {

        $userId = Auth::id();

        // Menghitung seluruh pengajuan konseling
        $totalCounseling = CounselingRequest::where('konseli_id', $userId)
            ->count();

        // Menghitung konseling yang masih berlangsung
        $activeCounseling = CounselingRequest::where('konseli_id', $userId)
            ->whereIn('status', ['pending', 'accepted'])
            ->whereHas('conversation', function ($query) {
                $query->where('status', 'active');
            })
            ->count();

        // Menghitung konseling yang sudah selesai
        $completedCounseling = CounselingRequest::where('konseli_id', $userId)
            ->whereHas('conversation', function ($query) {
                $query->where('status', 'closed');
            })
            ->count();

        return view('dashboards.konseli', compact(
            'totalCounseling',
            'activeCounseling',
            'completedCounseling'
        ));

    })->name('konseli.dashboard');

    // Pengajuan Konseling
    Route::get('/konseli/counseling', [CounselingRequestController::class, 'index'])
        ->name('konseli.counseling.index');

    Route::get('/konseli/counseling/create/{konselor}', [CounselingRequestController::class, 'create'])
        ->name('konseli.counseling.create');

    Route::post('/konseli/counseling/create/{konselor}', [CounselingRequestController::class, 'store'])
        ->name('konseli.counseling.store');

    // Riwayat Konseling
    Route::get('/konseli/counseling/history', [CounselingRequestController::class, 'history'])
        ->name('konseli.counseling.history');

    Route::get('/konseli/counseling/history/{id}', [CounselingRequestController::class, 'showHistory'])
        ->name('konseli.counseling.history.show');

    // Chat AI Companion dan Konselor
    Route::get('/konseli/chat/{id}', [ChatController::class, 'show'])
        ->name('konseli.chat.show');

    Route::post('/konse li/chat/{id}', [ChatController::class, 'store'])
        ->name('konseli.chat.store');

});


// Dashboard Konselor
Route::middleware(['auth', 'role:konselor'])->group(function () {

    Route::get('/konselor/dashboard', function () {

    $konselorId = Auth::id();

    // Total seluruh permintaan konseling
    $totalRequests = CounselingRequest::where('konselor_id', $konselorId)
        ->count();

    // Permintaan yang masih menunggu
    $pendingRequests = CounselingRequest::where('konselor_id', $konselorId)
        ->where('status', 'pending')
        ->count();

    // Konseling yang sedang berlangsung
    $activeCounseling = CounselingRequest::where('konselor_id', $konselorId)
        ->where('status', 'accepted')
        ->whereHas('conversation', function ($query) {
            $query->where('status', 'active');
        })
        ->count();

    // Konseling yang sudah selesai
    $completedCounseling = CounselingRequest::where('konselor_id', $konselorId)
        ->whereHas('conversation', function ($query) {
            $query->where('status', 'closed');
        })
        ->count();

    // Permintaan konseling terbaru
    $latestRequests = CounselingRequest::with('konseli')
        ->where('konselor_id', $konselorId)
        ->where('status', 'pending')
        ->latest()
        ->take(5)
        ->get();

    // Riwayat konseling terbaru
    $latestHistory = CounselingRequest::with('konseli', 'conversation')
        ->where('konselor_id', $konselorId)
        ->whereHas('conversation', function ($query) {
            $query->where('status', 'closed');
        })
        ->latest()
        ->take(5)
        ->get();

    return view('dashboards.konselor', compact(
        'totalRequests',
        'pendingRequests',
        'activeCounseling',
        'completedCounseling',
        'latestRequests',
        'latestHistory'
    ));

    })->name('konselor.dashboard');

    // Daftar Pengajuan Konseling
    Route::get('/konselor/counseling-requests', [KonselorCounselingRequestController::class, 'index'])
        ->name('konselor.counseling.index');

    // Detail Pengajuan
    Route::get('/konselor/counseling-requests/{id}', [KonselorCounselingRequestController::class, 'show'])
        ->name('konselor.counseling.show');

    // Menerima Pengajuan
    Route::patch('/konselor/counseling-requests/{id}/accept', [KonselorCounselingRequestController::class, 'accept'])
        ->name('konselor.counseling.accept');

    // Menolak Pengajuan
    Route::patch('/konselor/counseling-requests/{id}/reject', [KonselorCounselingRequestController::class, 'reject'])
        ->name('konselor.counseling.reject');
    
    // Mengubah Status Ketersediaan
    Route::patch('/konselor/availability', [AvailabilityController::class, 'update'])
        ->name('konselor.availability.update');

    // Chat Konseling Konselor
    Route::get('/konselor/chat/{id}', [KonselorChatController::class, 'show'])
        ->name('konselor.chat.show');

    Route::post('/konselor/chat/{id}', [KonselorChatController::class, 'store'])
        ->name('konselor.chat.store');

    // Chat Konselor
    Route::get('/konselor/chat/{id}', [\App\Http\Controllers\Konselor\ChatController::class, 'show'])
        ->name('konselor.chat.show');

    Route::post('/konselor/chat/{id}', [\App\Http\Controllers\Konselor\ChatController::class, 'store'])
        ->name('konselor.chat.store');

    Route::get('/konselor/counseling/history', [KonselorCounselingRequestController::class, 'history'])
    ->name('konselor.counseling.history');

    // Mengakhiri sesi konseling
    Route::patch('/konselor/chat/{id}/end', [KonselorChatController::class, 'end'])
        ->name('konselor.chat.end');
});


// Redirect Dashboard Berdasarkan Role
Route::get('/dashboard', function () {

    $role = Auth::user()->role;

    return match ($role) {
        'konseli' => redirect()->route('konseli.dashboard'),
        'konselor' => redirect()->route('konselor.dashboard'),
        default => abort(403),
    };

})->middleware('auth')->name('dashboard');


require __DIR__.'/auth.php';
