<?php

namespace App\Http\Controllers;

use App\Models\ForumDiskusi;
use App\Models\ResponDiskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumDiskusiController extends Controller
{
    public function index()
    {
        $forums = \App\Models\ForumDiskusi::orderByDesc('Id_Forum_Diskusi')->get();
        return view('forum-diskusi.index', compact('forums'));
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
        // Set the correct creator ID and role based on user role
        if ($user->role === 'mahasiswa') {
            $validated['Id_Mahasiswa'] = $user->Id_Mahasiswa;
        } elseif ($user->role === 'tim') {
            $validated['Id_Tim'] = $user->Id_Tim;
        } elseif ($user->role === 'korwil') {
            $validated['Id_Korwil'] = $user->Id_Korwil;
        } elseif ($user->role === 'dinas') {
            $validated['Id_Dinas'] = $user->Id_Dinas ?? null;
        }
        ForumDiskusi::create($validated);
        return redirect()->route('forum-diskusi.index')->with('success', 'Forum diskusi berhasil dibuat.');
    }

    public function show($id)
    {
        $forum = \App\Models\ForumDiskusi::with([
            'responDiskusi',
            'akunMahasiswa',
            'akunTim',
            'akunKorwil',
        ])->findOrFail($id);
        // Determine creator's name from the correct akun relation
        $namaAkun = null;
        if ($forum->Id_Mahasiswa && $forum->akunMahasiswa) {
            $namaAkun = $forum->akunMahasiswa->Nama_Akun;
        } elseif ($forum->Id_Tim && $forum->akunTim) {
            $namaAkun = $forum->akunTim->Nama_Akun;
        } elseif ($forum->Id_Korwil && $forum->akunKorwil) {
            $namaAkun = $forum->akunKorwil->Nama_Akun;
        } else {
            $namaAkun = 'Dinas';
        }
        // Eager load akun for each respon
        $forum->responDiskusi->load(['akunMahasiswa', 'akunTim', 'akunKorwil']);
        return view('forum-diskusi.show', compact('forum'))->with('namaAkunCreator', $namaAkun);
    }

    public function destroy($id)
    {
        $forum = ForumDiskusi::findOrFail($id);
        $forum->delete();
        return redirect()->route('forum-diskusi.index')->with('success', 'Forum diskusi dihapus.');
    }

    public function addRespon(Request $request, $id)
    {
        $request->validate([
            'Deskripsi' => 'required|string|max:1000',
        ]);
        $user = Auth::user();
        $forum = \App\Models\ForumDiskusi::findOrFail($id);
        $data = [
            'Id_Forum_Diskusi' => $forum->Id_Forum_Diskusi,
            'Deskripsi' => $request->Deskripsi,
            'Role_Pengirim' => $user->role,
        ];
        // Set Id_Pengirim for all roles
        if ($user->role === 'mahasiswa' && $user->Id_Mahasiswa) {
            $data['Id_Pengirim'] = $user->Id_Mahasiswa;
        } elseif ($user->role === 'tim' && $user->Id_Tim) {
            $data['Id_Pengirim'] = $user->Id_Tim;
        } elseif ($user->role === 'korwil' && $user->Id_Korwil) {
            $data['Id_Pengirim'] = $user->Id_Korwil;
        } elseif ($user->role === 'dinas' && $user->Id_Dinas) {
            $data['Id_Pengirim'] = $user->Id_Dinas;
        } else {
            $data['Id_Pengirim'] = null;
        }

        \App\Models\ResponDiskusi::create($data);
        return redirect()->route('forum-diskusi.show', $forum->Id_Forum_Diskusi)->with('success', 'Respon berhasil ditambahkan.');
    }
}
