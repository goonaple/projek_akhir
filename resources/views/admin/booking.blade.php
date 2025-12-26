@extends('admin.master')

@section('konten')
  <h2 class="text-2xl font-semibold mb-6">Data Booking</h2>

  <div class="bg-white shadow rounded-xl p-6 overflow-x-auto">

    {{-- Tombol Tambah --}}
    <div class="flex justify-between items-center mb-4">
      <button 
        id="openBooking" 
        class="bg-blue-600 text-white py-2 px-4 rounded-full text-sm font-medium hover:bg-blue-700 transition">
        Tambah Booking
      </button>
    </div>

    {{-- Tabel Data Booking --}}
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
        <tr>
          <th class="px-6 py-3">ID Booking</th>
          <th class="px-6 py-3">Nama</th>
          <th class="px-6 py-3">Tanggal</th>
          <th class="px-6 py-3">Nomor HP</th>
          <th class="px-6 py-3">Paket</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($data_booking as $item)
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="px-6 py-3">{{ $item->idBooking }}</td>
            <td class="px-6 py-3">{{ $item->nama }}</td>
            <td class="px-6 py-3">{{ $item->tanggal }}</td>
            <td class="px-6 py-3">{{ $item->no_hp }}</td>
            <td class="px-6 py-3">
              {{ $item->paket ? $item->paket->nama_paket : '-' }}
            </td>

            <td class="px-6 py-3">
              <span 
                class="px-3 py-1 rounded-full text-xs font-medium 
                       {{ $item->status === 'Selesai' ? 'bg-green-100 text-green-600' : ($item->status === 'Confirmed' ? 'bg-yellow-100 text-yellow-600' : ($item->status === 'Cancel' ? 'bg-red-100 text-red-600' : 'bg-orange-100 text-orange-600')) }}">
                {{ $item->status }}
              </span>
            </td>
            <td class="px-6 py-3 flex gap-2 justify-center">

              {{-- Tombol Edit --}}
              <button 
                class="updateBooking bg-orange-400 text-white py-2 px-4 rounded-full text-xs font-medium hover:bg-orange-500 transition"
                data-id="{{ $item->idBooking }}"
                data-nama="{{ $item->nama }}"
                data-tanggal="{{ $item->tanggal }}"
                data-nohp="{{ $item->no_hp }}"
                data-paket="{{ $item->paket->id_paket}}"
                data-status="{{ $item->status }}">
                Edit
              </button>

              {{-- Tombol Hapus --}}
              <form 
                action="/admin/booking/{{ $item->idBooking }}" 
                method="POST" 
                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                @csrf
                @method('DELETE')
                <button 
                  type="submit" 
                  class="bg-red-400 text-white py-2 px-4 rounded-full text-xs font-medium hover:bg-red-500 transition">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center py-6 text-gray-500">
              Belum ada data booking.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- Modal Tambah & Edit Booking --}}
    @include('admin.addBooking')
    @include('admin.updateBooking')

  </div>
@endsection
