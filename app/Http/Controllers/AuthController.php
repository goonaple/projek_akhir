<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            } 
            // else {
            //     return redirect()->intended('/user');
            // }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function index()
    {
        $data = User::get();
        return view('admin.listUser', [
            'data_user' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect('/admin/listUser')->with('pesan', 'Berhasil menambahkan user');
    }

   public function update(Request $request, $id)
    {
        // Validasi input dasar
        $request->validate([
            'edit_username' => 'required|string',
            'edit_role' => 'required|in:admin,user',
        ]);

        // Ambil data user berdasarkan id
        $user = User::where('id_user', $id)->firstOrFail();

        // Data dasar yang akan diupdate
        $updateData = [
            'username' => $request->edit_username,
            'role' => $request->edit_role,
        ];

        // Kalau user isi password baru
        if ($request->filled('edit_password_baru')) {
            // Pastikan password lama diisi
            if (!$request->filled('edit_password_lama')) {
                return back()->with('error', 'Password lama harus diisi untuk mengubah password.');
            }

            // Cek kecocokan password lama
            if (!Hash::check($request->edit_password_lama, $user->password)) {
                return back()->with('error', 'Password lama tidak sesuai.');
            }

            // Password lama cocok → ganti password baru
            $updateData['password'] = bcrypt($request->edit_password_baru);
        }

        // Jalankan update
        $user->update($updateData);

        return redirect('/admin/listUser')->with('pesan', 'Berhasil mengedit user.');
    }

    public function destroy($id)
    {
        User::where('id_user', $id)->delete();
        return redirect('/admin/listUser')->with('pesan', 'User berhasil dihapus');
    }
}







