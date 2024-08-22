<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $users = User::search($query)->orderBy('created_at', 'desc')->paginate(20);
        $unapprovedUserCount = User::countUnapprovedUsers();
        $message = $users->isEmpty() ? 'Data tidak ditemukan' : '';
        return view('admin.pengguna.index', compact('users', 'unapprovedUserCount', 'message'));
    }

    public function create()
    {
        return view('admin.pengguna.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'role', 'phone', 'email']));

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna berhasil dihapus');
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil disetujui.');
    }
}
