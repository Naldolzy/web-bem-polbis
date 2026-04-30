<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilBem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function index(): View
    {
        $profil = ProfilBem::getAllAsArray();
        $misi   = \App\Models\BemMisi::getAllOrdered();
        return view('admin.profil.index', compact('profil', 'misi'));
    }

    public function update(Request $request): RedirectResponse
    {
        // Validate file uploads upfront (before saving text fields)
        $request->validate([
            'logo_bem'    => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:10240',
            'logo_kampus' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:10240',
            'foto_ketua'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

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
            $old = ProfilBem::getValue('logo_bem');
            if ($old) Storage::disk('public')->delete($old);
            ProfilBem::set('logo_bem', $request->file('logo_bem')->store('profil', 'public'));
        }

        // Handle logo kampus upload
        if ($request->hasFile('logo_kampus')) {
            $old = ProfilBem::getValue('logo_kampus');
            if ($old) Storage::disk('public')->delete($old);
            ProfilBem::set('logo_kampus', $request->file('logo_kampus')->store('profil', 'public'));
        }

        // Handle foto ketua upload
        if ($request->hasFile('foto_ketua')) {
            $old = ProfilBem::getValue('foto_ketua');
            if ($old) Storage::disk('public')->delete($old);
            ProfilBem::set('foto_ketua', $request->file('foto_ketua')->store('profil', 'public'));
        }

        return back()->with('success', 'Profil BEM berhasil diperbarui!');
    }

    public function hapusFoto(string $key): RedirectResponse
    {
        $allowed = ['logo_bem', 'logo_kampus', 'foto_ketua'];
        if (!in_array($key, $allowed)) {
            abort(404);
        }

        $path = ProfilBem::getValue($key);
        if ($path) {
            Storage::disk('public')->delete($path);
        }
        ProfilBem::set($key, '');

        return back()->with('success', ucfirst(str_replace('_', ' ', $key)) . ' berhasil dihapus.');
    }
}
