<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booking;
use App\Models\paket;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index() {
        $data = booking::with('paket')->get();
        
        $pakets = paket::all();

        return view('admin.booking', [
            'data_booking' => $data,
            'data_paket' => $pakets,
        ]);
    }

    public function create() {        
        return view('admin.booking');
    }

    public function store(Request $request) {        
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'no_hp' => 'required',
        ]);

        Booking::create([
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'no_hp' => $request->no_hp,
            'paket_id' => $request->paket_id,
            'status' => 'pending',
        ]);

        return redirect('/admin/booking')->with('pesan', 'Berhasil menambahkan data');
    }

  public function update(Request $request)
    {
        $request->validate([
            'id1' => 'required',
            'nama1' => 'required',
            'tanggal1' => 'required',
            'no_hp1' => 'required',
            'paket_id1' => 'required',
            'status' => 'required',
        ]);

        booking::where('idBooking', $request->id1)->update([ // <-- pastikan kolomnya 'id', bukan 'idBooking'
            'nama' => $request->nama1,
            'tanggal' => $request->tanggal1,
            'no_hp' => $request->no_hp1,
            'paket_id' => $request->paket_id1,
            'status' => $request->status,
        ]);

        return redirect('/admin/booking')->with('pesan', 'Berhasil mengedit data');
    }



    public function destroy($id)
    {
        booking::where('idBooking', $id)->delete();
        return redirect('/admin/booking')->with('pesan', 'Data berhasil dihapus');
    }

    public function storeUser(Request $request)
    {
         try {
            Booking::create([
                'nama' => $request->nama,
                'tanggal' => $request->tanggal,
                'no_hp' => $request->telepon,
                'paket_id' => $request->paket_id, // diambil dari form user
                'status' => 'pending',
            ]);

            return redirect('/')->with('pesan', 'Booking berhasil dikirim!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function getBookingCounts()
    {
        $data = Booking::select('tanggal', DB::raw('COUNT(*) as jumlah'))
            ->where('status', '!=', 'Cancel')  // <-- filter selain canceled
            ->groupBy('tanggal')
            ->get();

        return response()->json($data);
    }

    public function getBookingsByDate($tanggal)
    {
       $bookings = Booking::with('paket')
    ->whereDate('tanggal', $tanggal)
    ->where('status', '!=', 'Cancel') // <-- filter canceled
    ->get();

        return response()->json($bookings);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id_paket');
    }
}
