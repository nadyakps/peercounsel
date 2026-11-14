<?php

namespace App\Http\Controllers\Konselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'availability_status' => 'required|in:available,away',
        ]);

        $konselor = Auth::user();

        $konselor->update([
            'availability_status' => $request->availability_status,
        ]);

        return back()->with(
            'success',
            'Status ketersediaan berhasil diperbarui.'
        );
    }
}
