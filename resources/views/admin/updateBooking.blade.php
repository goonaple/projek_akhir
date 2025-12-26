  <div id="bookingModal1" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md relative overflow-hidden p-6">
      
      <!-- Bagian Form -->
      <h3 class="text-xl font-semibold mb-4 text-center">Update Booking</h3>

      <form action="/admin/booking/{{ $item->idBooking }}" method="POST" id="bookingForm1" class="space-y-4">
        @method('PUT')
        @csrf

        <div>
          <input type="hidden" name="id1" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="nama1" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Tanggal Pemotretan</label>
          <input type="date" name="tanggal1" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
          <input type="tel" name="no_hp1" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="081234567890">
        </div>

        <div>
          <label for="paket1" class="block text-sm font-medium mb-1">Paket</label>
          <select id="paket1" name="paket_id1" required 
                  class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
            <option value="">-- Pilih Paket --</option>
            @foreach ($data_paket as $paket)
                <option value="{{ $paket->id_paket }}">
                    {{ $paket->nama_paket }} - Rp{{ number_format($paket->harga_paket, 0, ',', '.') }}
                </option>
            @endforeach
          </select>

        </div>

        <div>
          <label for="status" class="block text-sm font-medium mb-1">Sesi</label>
          <select name="status" id="status" required 
                  class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
            <option value="">--- Pilih Status  ---</option>
            <option value="Waiting">Waiting</option>
            <option value="Confirmed">Confirmed</option>
            <option value="Selesai">Selesai</option>
            <option value="Cancel">Cancel</option>
          </select>
        </div>

        <div class="flex justify-end space-x-2 mt-6">
          <button type="button" id="closeBooking1" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Kirim</button>
        </div>
      </form>

    </div>
  </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const bookingModal = document.getElementById('bookingModal1');
  const closeBooking = document.getElementById('closeBooking1');
  const editButtons = document.querySelectorAll('.updateBooking');

  if (!bookingModal || !closeBooking || editButtons.length === 0) return;

  editButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      const nama = btn.dataset.nama;
      const tanggal = btn.dataset.tanggal;
      const nohp = btn.dataset.nohp;
      const paketId = btn.dataset.paket;
      const status = btn.dataset.status;

      console.log("Debug paketId:", paketId);

      // Cek dan isi field satu per satu
      const idField = document.querySelector('input[name="id1"]');
      const namaField = document.querySelector('input[name="nama1"]');
      const tanggalField = document.querySelector('input[name="tanggal1"]');
      const nohpField = document.querySelector('input[name="no_hp1"]');
      const paketSelect = document.querySelector('select[name="paket_id1"]');
      const statusSelect = document.querySelector('select[name="status"]');

      if (idField) idField.value = id || '';
      if (namaField) namaField.value = nama || '';
      if (tanggalField) tanggalField.value = tanggal || '';
      if (nohpField) nohpField.value = nohp || '';

      // Reset selected dulu
      if (paketSelect) {
        let found = false;
        Array.from(paketSelect.options).forEach(opt => {
          if (opt.value.toString() === paketId.toString()) {
            opt.selected = true;
            found = true;
          } else {
            opt.selected = false;
          }
        });

        if (!found) {
          console.warn("⚠️ ID paket tidak ditemukan di dropdown:", paketId);
        }
      }

      if (statusSelect) statusSelect.value = status || '';

      bookingModal.classList.remove('hidden');
    });
  });

  closeBooking.addEventListener('click', () => {
    bookingModal.classList.add('hidden');
  });
});
</script>





