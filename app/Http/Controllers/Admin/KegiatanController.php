<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KegiatanController extends Controller
{
    public function index(): View
    {
        $kegiatan = Kegiatan::orderBy('tanggal_kegiatan', 'desc')->paginate(10);
        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create(): View
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'konten'           => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'kategori'         => 'required|string|max:100',
            'tanggal_kegiatan' => 'required|date',
            'is_published'     => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kegiatan', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']) . '-' . time();
        $validated['is_published'] = $request->boolean('is_published');

        Kegiatan::create($validated);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit(Kegiatan $kegiatan): View
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan): RedirectResponse
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'konten'           => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            'kategori'         => 'required|string|max:100',
            'tanggal_kegiatan' => 'required|date',
            'is_published'     => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kegiatan', 'public');
        }

        $validated['is_published'] = $request->boolean('is_published');

        $kegiatan->update($validated);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy(Kegiatan $kegiatan): RedirectResponse
    {
        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function hapusFoto(Kegiatan $kegiatan): RedirectResponse
    {
        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
            $kegiatan->update(['foto' => null]);
        }
        return back()->with('success', 'Foto kegiatan berhasil dihapus.');
    }
}
