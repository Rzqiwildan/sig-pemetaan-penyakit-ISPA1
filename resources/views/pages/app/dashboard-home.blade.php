<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Blade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-xl font-bold text-gray-800">BACOT</a>
            <div>
                <a href="#about" class="text-gray-700 hover:text-blue-500 px-4">About</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-500 px-4">Contact</a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 px-4">Login</a>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <section class="bg-blue-500 text-white py-20 text-center">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold">Sistem Informasi Geografis Pemetaan Penyakit ISPA</h1>
            <p class="mt-4 text-lg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
        </div>
    </section>

     <section id="map" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Disection ini menampilkan map & marker</h2>

        </div>
    </section>

    <section id="desa" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Jumlah Desa di Kecamatan Slawi</h2>
            <h2 class="text-3xl font-bold text-gray-800 mt-4">5</h2>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-20">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800">Tentang Kami</h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
        </div>
    </section>
</body>
</html>
