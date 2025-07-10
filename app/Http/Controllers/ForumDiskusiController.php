<?php

namespace App\Http\Controllers;

use App\Models\ForumDiskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumDiskusiController extends Controller
{
    public function index()
    {
        return view('forum-diskusi.index');
    }

    public function create()
    {
        return view('forum-diskusi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Judul' => 'required|string|max:150',
            'Deskripsi' => 'nullable|string',
        ]);
        $user = Auth::user();
        $validated['Nama_Mahasiswa'] = $user->mahasiswa->Nama_Mahasiswa ?? '';
        ForumDiskusi::create($validated);
        return redirect()->route('forum-diskusi.index')->with('success', 'Forum diskusi berhasil dibuat.');
    }

    public function show($id)
    {

        return view('forum-diskusi.show');
    }

    public function destroy($id)
    {
        $forum = ForumDiskusi::findOrFail($id);
        $forum->delete();
        return redirect()->route('forum-diskusi.index')->with('success', 'Forum diskusi dihapus.');
    }
}
