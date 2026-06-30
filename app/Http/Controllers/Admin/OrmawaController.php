<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ormawa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrmawaController extends Controller
{
    public function index()
    {
        $ormawas = Ormawa::orderBy('urutan')->orderBy('id')->get();
        return view('admin.ormawa.index', compact('ormawas'));
    }

    public function create()
    {
        return view('admin.ormawa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'singkatan'    => 'nullable|string|max:50',
            'prodi'        => 'nullable|string|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'deskripsi'    => 'nullable|string|max:500',
            'link_website' => 'nullable|url|max:500',
            'urutan'       => 'nullable|integer|min:0',
            'is_active'    => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('ormawa');
        }

        $validated['urutan']    = $validated['urutan'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        Ormawa::create($validated);

        return redirect()->route('admin.ormawa.index')
            ->with('success', 'Ormawa berhasil ditambahkan!');
    }

    public function destroy(Ormawa $ormawa)
    {
        if ($ormawa->logo) {
            Storage::delete($ormawa->logo);
        }
        $ormawa->delete();

        return redirect()->route('admin.ormawa.index')
            ->with('success', 'Ormawa berhasil dihapus.');
    }
}
