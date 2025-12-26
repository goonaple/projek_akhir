<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Studio Lumière</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex min-h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-white shadow-md p-6 flex flex-col fixed h-full">
    <h1 class="text-2xl font-semibold mb-10 text-center">Studio Lumière</h1>
    <nav class="space-y-2">
      <!-- <a href="#" class="block px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-100">Dashboard</a> -->
      <a href="/admin/booking" class="block px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-100">Data Booking</a>
      <a href="/admin/paket" class="block px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-100">List Paket</a>
      <hr></hr>
      <a href="/admin/logout" class="block px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-100">Logout</a>
    </nav>
    <div class="mt-auto text-center text-xs text-gray-400">
      © 2025 Studio Lumière
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 ml-64 p-8">
    @yield('konten')
  </main>  
</body>
</html>
