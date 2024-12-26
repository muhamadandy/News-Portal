<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci dari input pencarian
        $search = $request->input('search');

        // Query pengguna dengan pencarian, diurutkan dari yang terbaru
        $users = User::where('name', 'like', "%{$search}%")
                     ->orWhere('email', 'like', "%{$search}%")
                     ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at dari yang terbaru
                     ->paginate(10);

        // Memastikan query search ikut dalam pagination links
        $users->appends(['search' => $search]);

        return view('admin.users.index', compact('users', 'search'));
    }




     public function edit(User $user)
     {
         return view('admin.users.edit', compact('user'));
     }

     public function update(Request $request, User $user)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . $user->id,
         ]);

         $user->update($request->only('name', 'email'));

         if ($request->filled('password')) {
             $user->update(['password' => bcrypt($request->password)]);
         }

         return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
     }


     public function destroy(User $user)
     {

    if ($user->role === 'admin') {
        return redirect()->route('users.index')->with('error', 'User dengan peran admin tidak bisa dihapus.');
    }


    $user->delete();

    return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
     }
}