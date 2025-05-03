<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use App\Models\RiwayatPrediksi;

class DashboardController extends Controller
{
    public function index()
    {
        
        $totalDataTraining = DataTraining::count();
        $totalPrediksi = RiwayatPrediksi::count();
        $prediksiTerbaru = RiwayatPrediksi::latest()->first();
    
        return view('dashboard', compact('totalDataTraining', 'totalPrediksi', 'prediksiTerbaru'));
    
    }
}
