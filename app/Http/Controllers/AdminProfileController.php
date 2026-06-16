<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'tier_0') {
            $admins = User::all();
        } else {
            // Tier 1 dan Tier 2 tidak bisa melihat Tier 0.
            // Tier 2 sekarang bisa melihat daftar Tier 1 dan Tier 2 lainnya.
            $admins = User::whereIn('role', ['tier_1', 'tier_2'])->get();
        }
        return view('admin.profile.index', compact('admins'));
    }

    public function create()
    {
        if (Auth::user()->role === 'tier_2') {
            return redirect('/admin/profile')->with('error', 'Akses ditolak.');
        }
        return view('admin.profile.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'tier_2') {
            return redirect('/admin/profile')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:tier_1,tier_2',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/admin/profile')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'tier_2' && $user->id !== $admin->id) {
            return redirect('/admin/profile')->with('error', 'Akses ditolak.');
        }

        if ($user->role === 'tier_1' && $admin->role === 'tier_0') {
            return redirect('/admin/profile')->with('error', 'Akses ditolak. Tidak bisa mengedit Tier 0.');
        }

        if ($user->role === 'tier_1' && $admin->role === 'tier_1' && $user->id !== $admin->id) {
            return redirect('/admin/profile')->with('error', 'Akses ditolak. Tier 1 tidak bisa mengedit sesama Tier 1.');
        }

        return view('admin.profile.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'tier_2' && $user->id !== $admin->id) {
            return redirect('/admin/profile')->with('error', 'Akses ditolak.');
        }

        if ($user->role === 'tier_1' && $admin->role === 'tier_0') {
            return redirect('/admin/profile')->with('error', 'Akses ditolak. Tidak bisa mengedit Tier 0.');
        }

        if ($user->role === 'tier_1' && $admin->role === 'tier_1' && $user->id !== $admin->id) {
            return redirect('/admin/profile')->with('error', 'Akses ditolak. Tier 1 tidak bisa mengedit sesama Tier 1.');
        }

        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
        ];

        // Hanya validasi role untuk selain Tier 0, karena Tier 0 tidak boleh diubah role-nya via UI
        if ($user->role !== 'tier_2' && $request->has('role') && $admin->role !== 'tier_0') {
            $rules['role'] = 'required|in:tier_1,tier_2';
        }

        $request->validate($rules);

        $admin->name = $request->name;
        $admin->username = $request->username;
        
        // Update role hanya jika bukan tier_0 dan user berhak
        if ($user->role !== 'tier_2' && $request->has('role') && $admin->role !== 'tier_0') {
            $admin->role = $request->role;
        }

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect('/admin/profile')->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $user = Auth::user();

        if ($user->role === 'tier_2') {
            return redirect('/admin/profile')->with('error', 'Akses ditolak.');
        }

        if ($user->role === 'tier_1' && $admin->role === 'tier_0') {
            return redirect('/admin/profile')->with('error', 'Tier 1 tidak dapat menghapus admin Tier 0.');
        }

        if ($user->role === 'tier_1' && $admin->role === 'tier_1') {
            return redirect('/admin/profile')->with('error', 'Tier 1 tidak dapat menghapus sesama admin Tier 1.');
        }

        if ($user->id === $admin->id) {
            return redirect('/admin/profile')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();
        return redirect('/admin/profile')->with('success', 'Admin berhasil dihapus.');
    }
}
