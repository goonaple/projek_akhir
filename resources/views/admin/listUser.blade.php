@extends('admin.master')

@section('konten')
  <h2 class="text-2xl font-semibold mb-6">Data Admin</h2>

  <div class="bg-white shadow rounded-xl p-6 overflow-x-auto">

    {{-- Tombol Tambah --}}
    <div class="flex justify-between items-center mb-4">
      <button 
        id="openUser" 
        class="bg-blue-600 text-white py-2 px-4 rounded-full text-sm font-medium hover:bg-blue-700 transition">
        Tambah Admin
      </button>
    </div>

    {{-- Tabel Data User --}}
    <table class="w-full text-sm text-left border-collapse">
      <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
        <tr>
          <th class="px-6 py-3">ID</th>
          <th class="px-6 py-3">Username</th>
          <th class="px-6 py-3">Role</th>
          <th class="px-6 py-3 text-center">Aksi</th>
        </tr>
      </thead>

      <tbody>
        @forelse ($data_user as $user)
          <tr class="border-t hover:bg-gray-50 transition">
            <td class="px-6 py-3">{{ $user->id_user }}</td>
            <td class="px-6 py-3">{{ $user->username }}</td>
            <td class="px-6 py-3">
              <span class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-600' }}">
                {{ ucfirst($user->role) }}
              </span>
            </td>

            <td class="px-6 py-3 flex gap-2 justify-center">
              <!-- {{-- Tombol Edit --}}
              <button 
                class="updateUser bg-orange-400 text-white py-2 px-4 rounded-full text-xs font-medium hover:bg-orange-500 transition"
                data-id="{{ $user->id_user }}"
                data-username="{{ $user->username }}"
                data-role="{{ $user->role }}">
                Edit
              </button> -->

              {{-- Tombol Hapus --}}
              <form 
                action="/admin/listUser/{{ $user->id_user }}" 
                method="POST" 
                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
              Belum ada data user.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    {{-- Modal Tambah & Edit User --}}
    @include('admin.addUser')
    @include('admin.updateUser')
    
  </div>
@endsection
