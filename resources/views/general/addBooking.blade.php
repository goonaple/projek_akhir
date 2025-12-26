 <!-- Modal Booking -->
<div id="bookingModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl flex relative overflow-hidden">

    <!-- Bagian Gambar -->
    <div class="w-1/2 bg-gray-100">
      <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?w=600" 
           alt="Studio Lumiere" 
           class="w-full h-full object-cover">
    </div>

    <!-- Bagian Form -->
    <div class="w-1/2 p-6">
      <h3 class="text-xl font-semibold mb-4 text-center">Form Booking Sesi Foto</h3>

      <form action="/booking" method="POST" id="bookingForm" class="space-y-4">
        @csrf
        <div>
          <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
          <input type="text" id="nama2" name="nama" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Tanggal Pemotretan</label>
          <input type="date" id="tanggal2" name="tanggal" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
          <input type="tel" id="telepon2" name="telepon" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="081234567890">
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
</div>



 <script>
  const openBooking = document.getElementById('openBooking');
  const closeBooking = document.getElementById('closeBooking');
  const bookingModal = document.getElementById('bookingModal');

  openBooking.addEventListener('click', () => bookingModal.classList.remove('hidden'));
  closeBooking.addEventListener('click', () => bookingModal.classList.add('hidden'));

  const bookingForm = document.getElementById('bookingForm');

  bookingForm.addEventListener('submit', function (e) {
    // TUTUP MODAL DULU
    bookingModal.classList.add('hidden');

    // ALERT SETELAH MODAL TERTUTUP
    setTimeout(() => {
      alert('Booking berhasil, silahkan tunggu hingga admin mengkonfirmasi melalui chat WhatsApp');
    }, 300);
  });
</script>