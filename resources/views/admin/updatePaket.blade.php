<div id="paketModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-md relative overflow-hidden p-6">
    
    <!-- Bagian Form -->
    <h3 class="text-xl font-semibold mb-4 text-center">Update Paket</h3>

    <form action="/admin/paket/{{ $item->idPaket ?? '' }}" method="POST" id="paketForm" class="space-y-4">
      @method('PUT')
      @csrf

      <div>
        <input type="hidden" name="id" required class="w-full border border-gray-300 rounded-lg p-2">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Nama Paket</label>
        <input type="text" name="nama_paket" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="Contoh: Family">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Harga Paket</label>
        <input type="number" name="harga_paket" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="250000">
      </div>

      <div class="flex justify-end space-x-2 mt-6">
        <button type="button" id="closePaket" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan</button>
      </div>
    </form>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const paketModal = document.getElementById('paketModal');
  const closePaket = document.getElementById('closePaket');
  const editButtons = document.querySelectorAll('.updatePaket');

  editButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.getAttribute('data-id');
      const nama = btn.getAttribute('data-nama');
      const harga = btn.getAttribute('data-harga');

      // Set nilai input form
      document.querySelector('#paketForm input[name="id"]').value = id;
      document.querySelector('#paketForm input[name="nama_paket"]').value = nama;
      document.querySelector('#paketForm input[name="harga_paket"]').value = harga;

      // Ganti action URL dinamis
      document.getElementById('paketForm').action = `/admin/paket/${id}`;

      // Tampilkan modal
      paketModal.classList.remove('hidden');
    });
  });

  // Tutup modal
  closePaket.addEventListener('click', () => {
    paketModal.classList.add('hidden');
  });
});
</script>
