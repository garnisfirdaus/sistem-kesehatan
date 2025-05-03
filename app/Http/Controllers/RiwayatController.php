<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPrediksi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riwayatPrediksi = RiwayatPrediksi::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('riwayat.index', compact('riwayatPrediksi'));
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatPrediksi $riwayat)
    {
        // Check if the riwayat belongs to the authenticated user
        if ($riwayat->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('riwayat.show', compact('riwayat'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatPrediksi $riwayat)
    {
        // Check if the riwayat belongs to the authenticated user
        if ($riwayat->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $riwayat->delete();
        
        return redirect()->route('riwayat.index')
            ->with('success', 'Riwayat prediksi berhasil dihapus.');
    }
}


