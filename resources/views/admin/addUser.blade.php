<div id="userModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-lg w-full max-w-md relative overflow-hidden p-6">
    
    <!-- Bagian Form -->
    <h3 class="text-xl font-semibold mb-4 text-center">Tambah User</h3>

    <form action="/admin/listUser" method="POST" id="userForm" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium mb-1">Username</label>
        <input type="text" name="username" required 
               class="w-full border border-gray-300 rounded-lg p-2" placeholder="Masukkan username">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" required 
               class="w-full border border-gray-300 rounded-lg p-2" placeholder="Minimal 6 karakter">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Role</label>
        <select name="role" required 
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
          <option value="">-- Pilih Role --</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="flex justify-end space-x-2 mt-6">
        <button type="button" id="closeUser" class="px-4 py-2 bg-gray-200 rounded-lg">Batal</button>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Simpan</button>
      </div>
    </form>

  </div>
</div>

<script>
  const openUser = document.getElementById('openUser');
  const closeUser = document.getElementById('closeUser');
  const userModal = document.getElementById('userModal');

  openUser.addEventListener('click', () => userModal.classList.remove('hidden'));
  closeUser.addEventListener('click', () => userModal.classList.add('hidden'));
</script>
