<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Studio Lumière</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- Login Form -->
  <main class="flex-grow flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm mt-10 mb-10">
      <h2 class="text-2xl font-semibold text-center mb-3">Admin Studio Lumière</h2>

      <!-- ✅ Alert Section -->
      @if (session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded-lg p-3 text-center">
          {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="mb-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded-lg p-3 text-center">
          {{ session('error') }}
        </div>
      @endif

      <form action="/admin" method="POST" class="space-y-4">
        @csrf
        <!-- Username -->
        <div>
          <label for="username" class="block text-sm font-medium mb-1">Username</label>
          <input type="text" id="username" name="username" required
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium mb-1">Password</label>
          <input type="password" id="password" name="password" required
                class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-200">
        </div>

        <!-- Tombol Login -->
        <div>
          <button type="submit"
            class="flex w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition justify-center">
            Login
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="py-6 text-center text-gray-500 text-sm border-t">
    © 2025 Studio Lumière. Semua hak dilindungi.
  </footer>

</body>
</html>
