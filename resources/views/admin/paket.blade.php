@extends('admin.master')

@section('konten')
  <h2 class="text-2xl font-semibold mb-6">Data Paket</h2>

  <div class="bg-white shadow rounded-xl p-6 overflow-x-auto">

    {{-- Tombol Tambah --}}
    <div class="flex justify-between items-center mb-4">
      <button 
        id="openBooking" 
        class="bg-blue-600 text-white py-2 px-4 rounded-full text-sm font-medium hover:bg-blue-700 transition">
        Tambah Paket
      </button>
    </div>

    {{-- Tabel Data Paket --}}
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
        <tr>
          <th class="px-6 py-3">ID Paket</th>
          <th class="px-6 py-3">Nama Paket</th>
          <th class="px-6 py-3">Harga</th>
          <th class="px-6 py-3 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($data_paket as $item)
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="px-6 py-3">{{ $item->id_paket }}</td>
            <td class="px-6 py-3">{{ $item->nama_paket }}</td>
            <td class="px-6 py-3">Rp {{ number_format($item->harga_paket, 0, ',', '.') }}</td>
            <td class="px-6 py-3 flex gap-2 justify-center">

              {{-- Tombol Edit --}}
              <button 
                class="updatePaket bg-orange-400 text-white py-2 px-4 rounded-full text-xs font-medium hover:bg-orange-500 transition"
                data-id="{{ $item->id_paket }}"
                data-nama="{{ $item->nama_paket }}"
                data-harga="{{ $item->harga_paket }}">
                Edit
              </button>

              {{-- Tombol Hapus --}}
              <form 
                action="/admin/paket/{{ $item->id_paket }}" 
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
            <td colspan="4" class="text-center py-6 text-gray-500">
              Belum ada data paket.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- Modal Tambah & Edit Paket --}}
    @include('admin.addPaket')
    @include('admin.updatePaket')

  </div>
@endsection
