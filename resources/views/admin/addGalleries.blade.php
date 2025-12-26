<div id="bookingModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-md relative overflow-hidden p-6">
    
    <!-- Bagian Form -->
    <h3 class="text-xl font-semibold mb-4 text-center">Tambah Booking</h3>

    <form action="/admin/galeri" method="POST" id="bookingForm" class="space-y-4">
      @csrf
       <div class="mb-4">
        <label class="block text-sm mb-1">Upload Foto</label>
        <input type="file" name="foto" accept="image/*" required class="w-full border rounded p-2">
      </div>

      <div>
        <label for="paket" class="block text-sm font-medium mb-1">Paket</label>
        <select id="paket" name="paket_id" required 
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
          <option value="">-- Pilih Paket --</option>
          @foreach ($data_paket as $paket)
            <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }} - Rp{{ number_format($paket->harga_paket, 0, ',', '.') }}</option>
          @endforeach
        </select>
      </div>

      <div class="flex justify-end space-x-2 mt-6">
        <button type="button" id="closeBooking" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Kirim</button>
      </div>
    </form>

  </div>
</div>
  <script>
    const openBooking = document.getElementById('openBooking');
    const closeBooking = document.getElementById('closeBooking');
    const bookingModal = document.getElementById('bookingModal');

    openBooking.addEventListener('click', () => bookingModal.classList.remove('hidden'));
    closeBooking.addEventListener('click', () => bookingModal.classList.add('hidden'));

    // document.getElementById('bookingForm').addEventListener('submit', e => {
    //   e.preventDefault();
    //   // alert('Terima kasih! Booking kamu sudah dikirim.');
    //   bookingModal.classList.add('hidden');
    // });
  </script>