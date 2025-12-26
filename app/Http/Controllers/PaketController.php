<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paket;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
     public function index() {
        $data = Paket::get();
        return view('admin.paket', [
            'data_paket' => $data,
        ]);
    }

    public function create() {
        return view('admin.paket');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_paket' => 'required',
            'harga_paket' => 'required|numeric',
        ]);

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket,
        ]);

        return redirect('/admin/paket')->with('pesan', 'Berhasil menambahkan data');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_paket' => 'required',
            'harga_paket' => 'required|numeric',
        ]);

        Paket::where('id_paket', $id)->update([
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket,
        ]);

        return redirect('/admin/paket')->with('pesan', 'Berhasil mengedit data');
    }

    public function destroy($id) {
        Paket::where('id_paket', $id)->delete();
        return redirect('/admin/paket')->with('pesan', 'Data berhasil dihapus');
    }
}
