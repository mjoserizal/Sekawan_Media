<?php

namespace App\Http\Controllers\Admin;

use App\Exports\BookingsExport;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,approval,user' // Sesuaikan dengan peran yang diizinkan
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Beri respon berhasil
        return redirect()->route('admin.users.index')->with([
            'message' => 'berhasil di buat',
            'alert-type' => 'success'
        ]);
    }
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,approval,user' // Sesuaikan dengan peran yang diizinkan
        ]);

        // Update pengguna
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        // Beri respon berhasil
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
    public function export()
    {
        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }
    
}
