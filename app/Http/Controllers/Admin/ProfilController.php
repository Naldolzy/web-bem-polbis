<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilBem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilBem::getAllAsArray();
        $misi   = \App\Models\BemMisi::getAllOrdered();
        return view('admin.profil.index', compact('profil', 'misi'));
    }

    public function update(Request $request)
    {
        $fields = [
            'nama_bem', 'nama_kampus', 'periode', 'ketua_bem',
            'sambutan_ketua', 'visi',
            'email', 'instagram', 'youtube', 'tiktok', 'alamat', 'telepon', 'sejarah',
        ];

        foreach ($fields as $field) {
            ProfilBem::set($field, $request->input($field, ''));
        }

        // Handle logo BEM upload
        if ($request->hasFile('logo_bem')) {
            $request->validate(['logo_bem' => 'image|mimes:jpg,jpeg,png,webp,svg|max:10240']);
            $old = ProfilBem::get('logo_bem');
            if ($old) Storage::disk('public')->delete($old);
            ProfilBem::set('logo_bem', $request->file('logo_bem')->store('profil', 'public'));
        }

        // Handle logo kampus upload
        if ($request->hasFile('logo_kampus')) {
            $request->validate(['logo_kampus' => 'image|mimes:jpg,jpeg,png,webp,svg|max:10240']);
            $old = ProfilBem::get('logo_kampus');
            if ($old) Storage::disk('public')->delete($old);
            ProfilBem::set('logo_kampus', $request->file('logo_kampus')->store('profil', 'public'));
        }

        // Handle foto ketua upload
        if ($request->hasFile('foto_ketua')) {
            $request->validate(['foto_ketua' => 'image|mimes:jpg,jpeg,png,webp|max:10240']);
            $old = ProfilBem::get('foto_ketua');
            if ($old) Storage::disk('public')->delete($old);
            ProfilBem::set('foto_ketua', $request->file('foto_ketua')->store('profil', 'public'));
        }

        return back()->with('success', 'Profil BEM berhasil diperbarui!');
    }

    public function hapusFoto(string $key)
    {
        $allowed = ['logo_bem', 'logo_kampus', 'foto_ketua'];
        if (!in_array($key, $allowed)) {
            abort(404);
        }

        $path = ProfilBem::get($key);
        if ($path) {
            Storage::disk('public')->delete($path);
        }
        ProfilBem::set($key, '');

        return back()->with('success', ucfirst(str_replace('_', ' ', $key)) . ' berhasil dihapus.');
    }
}
