<?php

namespace App\Http\Controllers;

use App\Models\Korwil;
use Illuminate\Http\Request;

class KorwilController extends Controller
{
    public function index()
    {
        $korwils = Korwil::orderBy('Nama_Korwil')->get();
        return view('tim.data-korwil.index', compact('korwils'));
    }

    public function create()
    {
        return view('tim.data-korwil.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Korwil' => 'required|string|max:100',
        ]);
        Korwil::create($validated);
        return redirect()->route('tim.data-korwil')->with('success', 'Korwil berhasil ditambahkan.');
    }

    public function show($id)
    {
        $korwil = Korwil::findOrFail($id);
        return view('tim.data-korwil.show', compact('korwil'));
    }

    public function edit($id)
    {
        $korwil = Korwil::findOrFail($id);
        return view('tim.data-korwil.edit', compact('korwil'));
    }

    public function update(Request $request, $id)
    {
        $korwil = Korwil::findOrFail($id);
        $validated = $request->validate([
            'Nama_Korwil' => 'required|string|max:100',
        ]);
        $korwil->update($validated);
        return redirect()->route('tim.data-korwil')->with('success', 'Korwil berhasil diupdate.');
    }

    public function destroy($id)
    {
        $korwil = Korwil::findOrFail($id);
        $korwil->delete();
        return redirect()->route('tim.data-korwil')->with('success', 'Korwil berhasil dihapus.');
    }
}
