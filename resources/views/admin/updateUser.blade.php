<!-- Modal Edit User -->
<div id="userModal1" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-md relative overflow-hidden p-6">

    <!-- Judul -->
    <h3 class="text-xl font-semibold mb-4 text-center">Update User</h3>

    <!-- Form -->
    <form method="POST" id="userForm" class="space-y-4">
      @method('PUT')
      @csrf

      <!-- Hidden ID -->
      <input type="hidden" name="edit_id_user" id="edit_id_user">

      <!-- Username -->
      <div>
        <label for="edit_username" class="block text-sm font-medium mb-1">Username</label>
        <input 
          type="text" 
          name="edit_username" 
          id="edit_username"
          required 
          class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
      </div>

      <!-- Password Lama -->
      <div>
        <label for="edit_password_lama" class="block text-sm font-medium mb-1">Password Lama</label>
        <input 
          type="password" 
          name="edit_password_lama" 
          id="edit_password_lama"
          class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200" 
          placeholder="••••••••">
      </div>

      <!-- Password Baru -->
      <div>
        <label for="edit_password_baru" class="block text-sm font-medium mb-1">Password Baru (kosongkan jika tidak diubah)</label>
        <input 
          type="password" 
          name="edit_password_baru" 
          id="edit_password_baru"
          class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200" 
          placeholder="••••••••">
      </div>

      <!-- Role -->
      <div>
        <label for="edit_role" class="block text-sm font-medium mb-1">Role</label>
        <select 
          name="edit_role" 
          id="edit_role"
          required
          class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
          <option value="">-- Pilih Role --</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
      </div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end space-x-2 mt-6">
        <button type="button" id="closeUser" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const userModal = document.getElementById('userModal1');
  const closeUser = document.getElementById('closeUser');
  const editButtons = document.querySelectorAll('.updateUser');
  const form = document.getElementById('userForm');

  if (!userModal || !closeUser || !form) {
    console.error('Modal, tombol close, atau form tidak ditemukan');
    return;
  }

  // Klik tombol edit user
  editButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id || '';
      const username = btn.dataset.username || '';
      const role = btn.dataset.role || '';

      // Ambil elemen input langsung berdasarkan id (lebih aman)
      const idField = document.getElementById('edit_id_user');
      const usernameField = document.getElementById('edit_username');
      const roleField = document.getElementById('edit_role');
      const passLama = document.getElementById('edit_password_lama');
      const passBaru = document.getElementById('edit_password_baru');

      if (!idField || !usernameField || !roleField) {
        console.error('Elemen input tidak ditemukan di dalam form');
        return;
      }

      idField.value = id;
      usernameField.value = username;
      roleField.value = role;
      passLama.value = '';
      passBaru.value = '';

      form.action = `/admin/listUser/${id}`;
      userModal.classList.remove('hidden');
    });
  });

  // Tutup modal
  closeUser.addEventListener('click', () => {
    userModal.classList.add('hidden');
  });

  // Validasi sebelum submit
  form.addEventListener('submit', (e) => {
    const passwordLama = document.getElementById('edit_password_lama').value.trim();
    const passwordBaru = document.getElementById('edit_password_baru').value.trim();

    if (passwordBaru !== '' && passwordLama === '') {
      e.preventDefault();
      alert('Isi password lama untuk mengubah password.');
    }
  });
});
</script>
