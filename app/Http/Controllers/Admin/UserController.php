<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Superadmin cannot delete themselves, show all except current user at bottom
        $users = User::orderByRaw("CASE WHEN role = 'superadmin' THEN 1 WHEN role = 'admin' THEN 2 ELSE 3 END")->orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,superadmin',
        ]);

        $plainPassword = $request->password;

        User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => Hash::make($plainPassword),
            'plain_password' => Crypt::encryptString($plainPassword),
            'role'           => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun \"{$request->name}\" berhasil dibuat!");
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,superadmin',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password']       = Hash::make($request->password);
            $data['plain_password'] = Crypt::encryptString($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', "Akun \"{$user->name}\" berhasil diperbarui!");
    }

    public function destroy(User $user)
    {
        // Cannot delete own account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Akun \"{$name}\" berhasil dihapus.");
    }

    public function showPassword(User $user)
    {
        if (empty($user->plain_password)) {
            return response()->json(['password' => null, 'message' => 'Password tidak tersedia (dibuat sebelum fitur ini aktif atau diubah sendiri oleh admin).']);
        }

        try {
            $plain = Crypt::decryptString($user->plain_password);
            return response()->json(['password' => $plain]);
        } catch (\Exception $e) {
            return response()->json(['password' => null, 'message' => 'Gagal mendekripsi password.']);
        }
    }
}
