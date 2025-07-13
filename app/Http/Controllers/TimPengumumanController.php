<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanBantuanStudi;

class TimPengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['jadwal'])) {
            $jadwalArray = array_filter(array_map('trim', preg_split('/\r?\n/', $data['jadwal'])));
            $data['jadwal'] = $jadwalArray;
        }

        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if (isset($data['jadwal'])) {
            $jadwalArray = array_filter(array_map('trim', preg_split('/\r?\n/', $data['jadwal'])));
            $data['jadwal'] = $jadwalArray;
        }



        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}

