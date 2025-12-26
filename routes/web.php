<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AuthController;
use App\Models\paket;
use App\Models\gallery;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\GalleryController;


Route::get('/', function () {
    $pakets = paket::all();

    return view('welcome', [
        'data_paket' => $pakets,
    ]);
});

// Route::get('/booking', function () {
//     return view('general.booking');
// });


Route::post('/booking', [BookingController::class, 'storeUser']);

Route::get('/admin/booking', [BookingController::class, 'index']);
Route::get('/admin/booking/create', [BookingController::class, 'create']);
Route::post('/admin/booking', [BookingController::class, 'store']);
Route::get('/admin/booking/{id}/edit', [BookingController::class, 'edit']);
Route::put('/admin/booking/{id}', [BookingController::class, 'update']);
Route::delete('/admin/booking/{id}', [BookingController::class, 'destroy']);

Route::get('/admin/paket', [PaketController::class, 'index']);
Route::get('/admin/paket/create', [PaketController::class, 'create']);
Route::post('/admin/paket', [PaketController::class, 'store']);
Route::put('/admin/paket/{id}', [PaketController::class, 'update']);
Route::delete('/admin/paket/{id}', [PaketController::class, 'destroy']);

Route::get('/admin/listUser', [AuthController::class, 'index']);
Route::get('/admin/listUser/create', [AuthController::class, 'create']);
Route::post('/admin/listUser', [AuthController::class, 'store']);
Route::put('/admin/listUser/{id}', [AuthController::class, 'update']);
Route::delete('/admin/listUser/{id}', [AuthController::class, 'destroy']);

Route::get('/booking-counts', [BookingController::class, 'getBookingCounts']);
Route::get('/bookings/{tanggal}', [BookingController::class, 'getBookingsByDate']);

// 🧱 Halaman login admin
Route::get('/admin', function (Request $request) {
    // Kalau sudah login, jangan tampilkan form login lagi
    if ($request->session()->get('loggedIn')) {
        return redirect('/admin/booking');
    }

    return view('admin.login');
});

// 🧱 Proses login (pakai model User)
Route::post('/admin', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    $user = User::where('username', $username)->first();

    if ($user && Hash::check($password, $user->password)) {
        $request->session()->put('loggedIn', true);
        $request->session()->put('role', $user->role);
        return redirect('/admin/booking')->with('success', 'Berhasil login sebagai ' . $user->username . '!');
    }

    return back()->with('error', 'Username atau password salah!');
});

// 🧱 Logout
Route::get('/admin/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/admin')->with('success', 'Berhasil logout.');
});

// 🧱 Route yang butuh login admin
Route::middleware(['check.admin'])->group(function () {
    Route::get('/admin/booking', [BookingController::class, 'index']);
    Route::get('/admin/paket', [PaketController::class, 'index']);
});