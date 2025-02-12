@extends('layouts.app')

@section('title', 'New User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 300px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>New User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Tambah Data</div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <form action="" method="POST">

                        @csrf
                        <div class="card-header">
                            <h4>Data Baru</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Desa</label>
                                <input type="text" class="form-control" name="nama_penyakit">
                            </div>

                            <div class="form-group">
                                <label>Jumlah Terkena</label>
                                <input type="text" class="form-control" name="jumlah_terkena">
                            </div>

                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude">
                            </div>

                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude">
                            </div>

                            <div class="form-group">
    <label>Marker Color</label>
    <select id="markerColor" class="form-control" name="marker_color">
        <option value="red">Red</option>
        <option value="blue">Blue</option>
        <option value="green">Green</option>
        <option value="orange">Orange</option>
    </select>
</div>


                            <div class="form-group mb-0">
                                <label>Address</label>
                                <textarea class="form-control" data-height="150" name="address"></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label>Map Location</label>
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.200000, 106.816666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        function getIcon(color) {
            return new L.Icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        }

        var marker = L.marker([-6.200000, 106.816666], {
            draggable: true,
            icon: getIcon('red')
        }).addTo(map);

        function updateMarker(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        document.getElementById('latitude').addEventListener('input', function() {
            var lat = parseFloat(this.value);
            var lng = parseFloat(document.getElementById('longitude').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                updateMarker(lat, lng);
            }
        });

        document.getElementById('longitude').addEventListener('input', function() {
            var lat = parseFloat(document.getElementById('latitude').value);
            var lng = parseFloat(this.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                updateMarker(lat, lng);
            }
        });

        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });

        document.getElementById('markerColor').addEventListener('change', function() {
            var color = this.value;
            marker.setIcon(getIcon(color));
        });
    </script>
@endpush
