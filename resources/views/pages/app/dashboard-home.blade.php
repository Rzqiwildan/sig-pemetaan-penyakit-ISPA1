<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Blade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">BACOT</a>

            <!-- Menu Toggle Button -->
            <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
                ☰
            </button>

            <!-- Menu -->
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="/" class="text-gray-700 hover:text-blue-500 px-4">Home</a>
                <a href="{{ route('data.desa') }}" class="text-gray-700 hover:text-blue-500 px-4">Data Desa</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-4">Login</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white p-4">
            <a href="/" class="block text-gray-700 hover:text-blue-500 py-2">Home</a>
            <a href="{{ route('data.desa') }}" class="block text-gray-700 hover:text-blue-500 py-2">Data Desa</a>
            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-500 py-2">Login</a>
        </div>
    </nav>

    <!-- Banner -->
    <section class="bg-blue-500 text-white py-20 text-center px-4">
        <div class="container mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">Sistem Informasi Geografis Pemetaan Penyakit ISPA</h1>
            <p class="mt-4 text-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
    </section>

    <!-- Pemetaan -->
    <section id="map" class="py-20 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Pemetaan Kasus ISPA</h2>
            <div id="mapid" class="h-64 md:h-96 mt-8 rounded-lg shadow-md"></div>
        </div>
    </section>

    <!-- Jumlah Desa -->
    <section id="desa" class="py-20 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Jumlah Desa di Kecamatan Slawi</h2>
            <h2 class="text-3xl font-bold text-gray-800 mt-4">5</h2>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-20 px-4">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Tentang Kami</h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-500 text-white py-6 text-center">
        <p class="text-sm">© 2023 BACOT. All rights reserved.</p>
    </footer>

    <!-- Leaflet Map -->
    <script>
        var mymap = L.map('mapid').setView([-6.9848164, 109.0898518], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);

        $.ajax({
            url: '{{ route('get.locations') }}',
            method: 'GET',
            success: function (response) {
                response.forEach(function (location) {
                    var markerColor = location.marker_color || 'red';
                    var markerIcon = L.icon({
                        iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-${markerColor}.png`,
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    });

                    var marker = L.marker([location.latitude, location.longitude], { icon: markerIcon }).addTo(mymap);

                    var popupContent = `
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">${location.nama_desa}</h3>
                            <div class="text-gray-700">
                                <p class="mb-1">Jumlah Kasus: ${location.jumlah_terkena}</p>
                                ${location.address ? `<p class="text-sm">${location.address}</p>` : ''}
                            </div>
                        </div>
                    `;
                    marker.bindPopup(popupContent);
                });
            },
            error: function (error) {
                console.error('Error fetching locations:', error);
            }
        });

        // Navbar Mobile Toggle
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>
