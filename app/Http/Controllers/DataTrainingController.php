<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;

class DataTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTrainings = DataTraining::latest()->paginate(10);
        return view('data-training.index', compact('dataTrainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-training.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'gaya_hidup' => 'required|string|max:255',
            'riwayat_penyakit' => 'required|string|max:255',
            'status_kesehatan' => 'required|string|max:255',
        ]);

        DataTraining::create($request->all());

        return redirect()->route('data-training.index')
            ->with('success', 'Data training berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataTraining $dataTraining)
    {
        return view('data-training.show', compact('dataTraining'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataTraining $dataTraining)
    {
        return view('data-training.edit', compact('dataTraining'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataTraining $dataTraining)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:1|max:120',
            'gaya_hidup' => 'required|string|max:255',
            'riwayat_penyakit' => 'required|string|max:255',
            'status_kesehatan' => 'required|string|max:255',
        ]);

        $dataTraining->update($request->all());

        return redirect()->route('data-training.index')
            ->with('success', 'Data training berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataTraining $dataTraining)
    {
        $dataTraining->delete();

        return redirect()->route('data-training.index')
            ->with('success', 'Data training berhasil dihapus.');
    }
}

