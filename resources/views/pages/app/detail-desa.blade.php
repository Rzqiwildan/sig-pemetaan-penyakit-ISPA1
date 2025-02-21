<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">BACOT</a>
            <button id="menu-btn" class="md:hidden text-gray-700 focus:outline-none">
                ☰
            </button>
            <div id="menu" class="hidden md:flex space-x-4">
                <a href="/" class="text-gray-700 hover:text-blue-500 px-4">Home</a>
                <a href="{{ route('data.desa') }}" class="text-gray-700 hover:text-blue-500 px-4">Data Desa</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-4">Login</a>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md">
            <a href="/" class="block text-gray-700 hover:text-blue-500 p-4">Home</a>
            <a href="{{ route('data.desa') }}" class="block text-gray-700 hover:text-blue-500 p-4">Data Desa</a>
            <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-500 p-4">Login</a>
        </div>
    </nav>

    <section class="container mx-auto py-16 px-4">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
            <p class="text-lg"><strong>Nama Desa:</strong> {{ $location->nama_desa }}</p>
            <p class="text-lg"><strong>Jumlah Kasus ISPA:</strong> {{ $location->jumlah_terkena }}</p>
            <p class="text-lg"><strong>Latitude:</strong> {{ $location->latitude }}</p>
            <p class="text-lg"><strong>Longitude:</strong> {{ $location->longitude }}</p>
            <div id="map" class="w-full h-64 mt-4 rounded-lg"></div>
        </div>

        <h2 class="text-2xl font-bold text-gray-800 mt-10 text-center">Daftar Penduduk</h2>
        <div class="overflow-x-auto mt-4">
            <table class="w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">No</th>
                        <th class="py-3 px-6 text-center">Nama</th>
                        <th class="py-3 px-6 text-center">Umur</th>
                        <th class="py-3 px-6 text-center">Jenis Kelamin</th>
                        <th class="py-3 px-6 text-center">Alamat</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($penduduks as $index => $penduduk)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-center">{{ $penduduk->nama }}</td>
                        <td class="py-3 px-6 text-center">{{ $penduduk->umur }}</td>
                        <td class="py-3 px-6 text-center">{{ $penduduk->jenis_kelamin }}</td>
                        <td class="py-3 px-6 text-center">{{ $penduduk->alamat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <footer class="bg-blue-500 text-white py-6 text-center">
        <p class="text-sm">© 2023 BACOT. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        document.addEventListener("DOMContentLoaded", function () {
            var latitude = {{ $location->latitude }};
            var longitude = {{ $location->longitude }};
            var markerColor = "{{ $location->marker_color }}";

            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var customIcon = L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${markerColor}.png`,
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            L.marker([latitude, longitude], { icon: customIcon }).addTo(map)
                .bindPopup("{{ $location->nama_desa }}")
                .openPopup();
        });
    </script>
</body>
</html>
