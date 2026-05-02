<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $isLocked   = SiteSetting::isLocked();
        $lockReason = SiteSetting::lockReason();
        return view('admin.site-settings.index', compact('isLocked', 'lockReason'));
    }

    public function lock(Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        SiteSetting::set('site_locked', '1');
        SiteSetting::set('lock_reason', $request->reason);

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Website berhasil dikunci! Pengunjung akan melihat halaman maintenance.');
    }

    public function unlock()
    {
        SiteSetting::set('site_locked', '0');
        SiteSetting::set('lock_reason', null);

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Website berhasil dibuka! Pengunjung sudah bisa mengakses website.');
    }
}
