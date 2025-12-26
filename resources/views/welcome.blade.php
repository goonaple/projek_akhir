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
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="h-screen flex items-center justify-center bg-[url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4')] bg-cover bg-center relative">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative text-center text-white px-6">
      <h2 class="text-4xl md:text-6xl font-bold mb-4">Abadikan Momen Terindahmu</h2>
      <p class="text-lg md:text-xl mb-8 max-w-xl mx-auto">Studio foto profesional untuk prewedding, potret keluarga, hingga personal branding.</p>
      <a href="#jadwal" class="bg-white text-gray-900 px-6 py-3 mx-3 rounded-full font-semibold hover:bg-gray-100 transition inline-block">Cek Jadwal Booking</a>
      <button id="openBooking" class="bg-white text-gray-900 px-6 py-3 mx-3 rounded-full font-semibold hover:bg-gray-100 transition">Booking Sekarang</button>
    </div>
  </section>

  <!-- Jadwal Booking Section -->
 <section id="jadwal" class="py-20">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <h3 class="text-3xl font-semibold mb-10">Jadwal Booking</h3>
    
    <div class="grid grid-cols-3 items-center mb-4">
      <button id="prevMonth" class="px-2 py-1 bg-white rounded hover:bg-gray-100 justify-self-end">&lt;</button>
      <h4 id="monthYear" class="text-lg font-semibold text-center justify-self-center"></h4>
      <button id="nextMonth" class="px-2 py-1 bg-white rounded hover:bg-gray-100 justify-self-start">&gt;</button>
    </div>

    <!-- Nama Hari -->
    <div class="grid grid-cols-7 text-center font-medium text-sm mb-2">
      <div>Min</div>
      <div>Sen</div>
      <div>Sel</div>
      <div>Rab</div>
      <div>Kam</div>
      <div>Jum</div>
      <div>Sab</div>
    </div>

    <!-- Kalender -->
    <div id="calendar" class="grid grid-cols-7 gap-2 text-center text-sm flex flex-1 min-h-[300px]"></div>

    <div class="flex flex-wrap justify-end items-center mt-3 gap-3 p-3 bg-gray-50 rounded-lg border mb-4">
      <div class="flex items-center gap-2">
        <div class="w-4 h-4 bg-orange-400 border border-gray-400 rounded-sm"></div>
        <span class="text-sm text-gray-700">Full Booked</span>
      </div>
      <div class="flex items-center gap-2">
        <div class="w-4 h-4 bg-yellow-300 border border-gray-400 rounded-sm"></div>
        <span class="text-sm text-gray-700">Almost Full</span>
      </div>
      <div class="flex items-center gap-2">
        <div class="w-4 h-4 bg-white border border-gray-400 rounded-sm"></div>
        <span class="text-sm text-gray-700">Available</span>
      </div>
    </div>
  </div>

  <!-- Popup Modal -->
  <div id="popupModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[90%] max-w-md text-center relative">
      <h4 class="text-lg font-semibold mb-3">Detail Booking</h4>
      <p id="popupDate" class="text-gray-700 mb-4 font-medium"></p>
      <div id="popupContent" class="text-sm text-gray-600 space-y-2 max-h-60 overflow-y-auto"></div>
      <button id="closePopup" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tutup</button>
    </div>
  </div>

  <script>
    const calendar = document.getElementById("calendar");
    const monthYear = document.getElementById("monthYear");
    const prevMonthBtn = document.getElementById("prevMonth");
    const nextMonthBtn = document.getElementById("nextMonth");

    const popupModal = document.getElementById("popupModal");
    const popupDate = document.getElementById("popupDate");
    const popupContent = document.getElementById("popupContent");
    const closePopup = document.getElementById("closePopup");

    let currentDate = new Date();
    let bookingCounts = {};

    // Ambil jumlah booking per tanggal
    async function fetchBookingCounts() {
      const response = await fetch("/booking-counts");
      const data = await response.json();
      bookingCounts = {};
      data.forEach(item => {
        bookingCounts[item.tanggal] = item.jumlah;
      });
      renderCalendar(currentDate);
    }

    function renderCalendar(date) {
      calendar.innerHTML = "";
      const year = date.getFullYear();
      const month = date.getMonth();
      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);
      const startDay = firstDay.getDay();
      const daysInMonth = lastDay.getDate();

      monthYear.textContent = date.toLocaleString("id-ID", { month: "long", year: "numeric" });

      const totalCells = 42;

      // Kosong sebelum tanggal 1
      for (let i = 0; i < startDay; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("text-gray-300");
        calendar.appendChild(emptyCell);
      }

      // Generate tanggal
      for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        cell.textContent = day;
        cell.classList.add("py-2", "rounded", "cursor-pointer", "border", "hover:bg-gray-100",   "flex", "justify-center",  "items-center");

        const tanggalString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const jumlah = bookingCounts[tanggalString] || 0;

        if (jumlah > 3) {
          cell.classList.add("bg-orange-400", "hover:bg-orange-500");
        } else if (jumlah > 0) {
          cell.classList.add("bg-yellow-200", "hover:bg-yellow-300");
        } else {
          cell.classList.add("pointer-events-none");
        }

        // Klik tanggal → tampilkan popup detail
        cell.addEventListener("click", async () => {
          popupDate.textContent = `Tanggal: ${tanggalString}`;
          popupContent.innerHTML = "<p class='text-gray-400'>Memuat data...</p>";
          popupModal.classList.remove("hidden");

          const res = await fetch(`/bookings/${tanggalString}`);
          const data = await res.json();

          if (data.length === 0) {
            popupContent.innerHTML = "<p class='text-gray-400'>Tidak ada booking pada tanggal ini.</p>";
          } else {
            popupContent.innerHTML = data.map((b, i) => `
            <div class="border rounded p-2 text-left">
              <p><strong>${i + 1}. ${b.nama}</strong></p>
              <p>Paket: ${b.paket ? b.paket.nama_paket : '-'}</p>
            </div>
          `).join("");
          }
        });

        calendar.appendChild(cell);
      }

      // Tambah cell kosong setelah akhir bulan
      const filledCells = startDay + daysInMonth;
      for (let i = filledCells; i < totalCells; i++) {
        const emptyCell = document.createElement("div");
        emptyCell.classList.add("text-gray-300");
        calendar.appendChild(emptyCell);
      }
    }

    prevMonthBtn.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() - 1);
      renderCalendar(currentDate);
    });

    nextMonthBtn.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() + 1);
      renderCalendar(currentDate);
    });

    closePopup.addEventListener("click", () => {
      popupModal.classList.add("hidden");
    });

    fetchBookingCounts();
  </script>

</section>
  @include('general.addBooking')

  <!-- Footer -->
  <footer class="py-8 text-center text-gray-500 text-sm border-t">
    © 2025 Studio Lumière. Semua hak dilindungi.
  </footer>
</body>
</html>