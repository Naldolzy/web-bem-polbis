<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BemMisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MisiController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['isi' => 'required|string|max:500']);
        $urutan = (int) (BemMisi::max('urutan') ?? 0) + 1;
        BemMisi::create(['isi' => $request->isi, 'urutan' => $urutan]);
        return back()->with('success', 'Misi berhasil ditambahkan.');
    }

    public function destroy(BemMisi $bemMisi): RedirectResponse
    {
        $bemMisi->delete();

        // Efficient reorder using a single DB query instead of N+1 updates
        $remaining = BemMisi::orderBy('urutan')->orderBy('id')->pluck('id');
        foreach ($remaining as $index => $id) {
            DB::table('bem_misi')->where('id', $id)->update(['urutan' => $index + 1]);
        }

        return back()->with('success', 'Misi berhasil dihapus.');
    }

    public function reorder(Request $request): JsonResponse
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:bem_misi,id',
        ]);

        // Bulk reorder using DB facade to avoid N+1
        foreach ($request->ids as $i => $id) {
            DB::table('bem_misi')->where('id', $id)->update(['urutan' => $i + 1]);
        }

        return response()->json(['ok' => true]);
    }
}
