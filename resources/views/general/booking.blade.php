<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Studio Lumière</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <header class="fixed w-full bg-white/80 backdrop-blur-md z-50 shadow-sm">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-semibold tracking-wide">Studio Lumière</h1>
      <nav class="space-x-6 text-sm font-medium">
        <a href="#home" class="hover:text-gray-600">Beranda</a>
        <a href="#about" class="hover:text-gray-600">Tentang</a>
        <a href="#gallery" class="hover:text-gray-600">Galeri</a>
        <a href="#contact" class="hover:text-gray-600">Kontak</a>
      </nav>
      <button id="openBooking" class="ml-6 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">
        Booking Sekarang
      </button>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="h-screen flex items-center justify-center bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4')] bg-cover bg-center relative">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative text-center text-white px-6">
      <h2 class="text-4xl md:text-6xl font-bold mb-4">Abadikan Momen Terindahmu</h2>
      <p class="text-lg md:text-xl mb-8 max-w-xl mx-auto">Studio foto profesional untuk prewedding, potret keluarga, hingga personal branding.</p>
      <a href="\booking" class="bg-white text-gray-900 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Booking Sekarang</a>
    </div>
  </section>

  <!-- Gallery Section -->
  <section id="gallery" class="py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-semibold mb-10">Galeri Kami</h3>
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e" alt="Gallery 1" class="rounded-lg shadow-sm hover:scale-105 transition" />
        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e" alt="Gallery 2" class="rounded-lg shadow-sm hover:scale-105 transition" />
        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e" alt="Gallery 3" class="rounded-lg shadow-sm hover:scale-105 transition" />
        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e" alt="Gallery 4" class="rounded-lg shadow-sm hover:scale-105 transition" />
        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e" alt="Gallery 5" class="rounded-lg shadow-sm hover:scale-105 transition" />
        <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e" alt="Gallery 6" class="rounded-lg shadow-sm hover:scale-105 transition" />
      </div>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <h3 class="text-3xl font-semibold mb-6">Tentang Kami</h3>
      <p class="text-gray-600 leading-relaxed max-w-2xl mx-auto">
        Kami adalah tim fotografer berpengalaman yang berfokus pada penciptaan foto dengan estetika dan emosi. 
        Setiap jepretan adalah cerita, dan kami ingin membantu Anda menyimpannya selamanya.
      </p>
    </div>
  </section>


  <!-- Footer -->
  <footer class="py-8 text-center text-gray-500 text-sm border-t">
    © 2025 Studio Lumière. Semua hak dilindungi.
  </footer>

  <!-- Modal Booking -->
  <div id="bookingModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-6 relative">
      <h3 class="text-xl font-semibold mb-4 text-center">Form Booking Sesi Foto</h3>

      <form id="bookingForm" class="space-y-4">
        <div>
          <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
          <input type="text" id="nama" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Tanggal Pemotretan</label>
          <input type="date" id="tanggal" required class="w-full border border-gray-300 rounded-lg p-2">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Nomor Telepon</label>
          <input type="tel" id="telepon" required class="w-full border border-gray-300 rounded-lg p-2" placeholder="081234567890">
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

    document.getElementById('bookingForm').addEventListener('submit', e => {
      e.preventDefault();
      alert('Terima kasih! Booking kamu sudah dikirim.');
      bookingModal.classList.add('hidden');
    });
  </script>
</body>
</html>