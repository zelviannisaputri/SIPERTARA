<x-app-layout>
    <title>Tentang Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="min-h-screen flex flex-col items-center">
        <div class="p-8 rounded-lg shadow-lg w-full">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tentang Kami</h1>
            <div class="flex flex-col lg:flex-row">
                <!-- Konten -->
                <div class="lg:w-1/2 lg:pr-8 mb-6 lg:mb-0">
                    <p class="text-justify mb-6">Sistem Informasi Pengelolaan dan Registrasi Tanah Rumbai Barat
                        (SIPERTARA) adalah platform digital yang dirancang untuk memudahkan pengelolaan
                        dan pengecekan registrasi surat tanah di wilayah Rumbai Barat. Dengan sistem ini, Anda dapat
                        mengajukan permohonan dan memantau status pengecekan registrasi secara efisien. Bergabunglah
                        bersama kami untuk mewujudkan pelayanan publik yang lebih baik!
                    </p>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Visi</h3>
                    <p class="text-justify mb-6">Menjadi platform terdepan dalam pengelolaan administrasi tanah yang
                        terintegrasi dan berorientasi pada pelayanan publik yang prima.</p>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Misi</h3>
                    <ul class="list-disc list-inside pl-4">
                        <li class="mb-2">Memberikan kemudahan akses dan transparansi informasi mengenai proses
                            administrasi tanah.</li>
                        <li class="mb-2">Menjaga integritas dan keamanan data pengguna dalam setiap transaksi
                            administrasi tanah.</li>
                        <li class="mb-2">Terus mengembangkan sistem untuk meningkatkan efisiensi dan kualitas
                            pelayanan.</li>
                    </ul>
                </div>
                <!-- Gambar -->
                <div class="lg:w-1/2 flex items-center justify-center">
                    <img src="{{ asset('images/sitara.png') }}" alt="SITARA Logo"
                        class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
