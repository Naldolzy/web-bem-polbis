<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BemMisi;
use Illuminate\Http\Request;

class MisiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['isi' => 'required|string|max:500']);
        $urutan = BemMisi::max('urutan') + 1;
        BemMisi::create(['isi' => $request->isi, 'urutan' => $urutan]);
        return back()->with('success', 'Misi berhasil ditambahkan.');
    }

    public function destroy(BemMisi $bemMisi)
    {
        $bemMisi->delete();
        // Reorder remaining
        BemMisi::getAllOrdered()->each(function ($m, $i) {
            $m->update(['urutan' => $i + 1]);
        });
        return back()->with('success', 'Misi berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        // Accepts array of ids in new order
        $request->validate(['ids' => 'required|array', 'ids.*' => 'integer|exists:bem_misi,id']);
        foreach ($request->ids as $i => $id) {
            BemMisi::where('id', $id)->update(['urutan' => $i + 1]);
        }
        return response()->json(['ok' => true]);
    }
}
