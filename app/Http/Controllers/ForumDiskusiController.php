<?php

namespace App\Http\Controllers;

use App\Models\ForumDiskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumDiskusiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $forums = ForumDiskusi::where('Nama_Mahasiswa', $user->mahasiswa->Nama_Mahasiswa ?? '')->get();
        return view('mahasiswa.forum-diskusi.index', compact('forums'));
    }

    public function create()
    {
        return view('mahasiswa.forum-diskusi.create');
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
        $forum = ForumDiskusi::findOrFail($id);
        return view('mahasiswa.forum-diskusi.show', compact('forum'));
    }

    public function destroy($id)
    {
        $forum = ForumDiskusi::findOrFail($id);
        $forum->delete();
        return redirect()->route('forum-diskusi.index')->with('success', 'Forum diskusi dihapus.');
    }
}
