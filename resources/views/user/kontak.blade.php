<x-app-layout>
    <title>Kontak Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="min-h-screen flex flex-col items-center">
        <div class="p-8 rounded-lg shadow-lg w-full">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Kontak Kami</h1>
            <p class="text-center mb-6">Silakan hubungi kami jika Anda memerlukan bantuan atau informasi lebih lanjut
                mengenai aplikasi Sistem Informasi Pengelolaan dan Registrasi Tanah Rumbai Barat (SIPERTARA).</p>

            <div class="flex flex-col lg:flex-row lg:space-x-8">
                <!-- Informasi Kontak -->
                <div class="lg:flex-1 mb-6 lg:mb-0">
                    <h3 class="text-xl font-semibold mb-4">Informasi Kontak</h3>
                    <ul class="space-y-4">
                        <li><strong>Alamat:</strong> <a href="https://maps.app.goo.gl/NGnv1dCpndadvcBB6" target="_blank"
                                class="text-blue-600 hover:underline"><i class="fas fa-map-marker-alt"></i> Jalan Tengku
                                Kasim Perkasa Rumbai Barat</a></li>
                        <li><strong>Telepon:</strong> (0761) 123456</li>
                        <li><strong>Email:</strong> <a href="mailto:info@sitara-pekanbaru.com"
                                class="text-blue-600 hover:underline"><i class="fas fa-envelope"></i>
                                info@sitara-pekanbaru.com</a></li>
                    </ul>

                    <h3 class="text-xl font-semibold mt-6 mb-4">Jam Operasional</h3>
                    <p>Kami melayani Anda pada hari Senin sampai Jumat, pukul 08:00 - 16:00 WIB.</p>
                </div>

                <!-- Formulir Kontak -->
                <div class="lg:flex-1">
                    <h3 class="text-xl font-semibold mb-4">Kirim Pesan</h3>
                    <form action="/send-message" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block mb-2 font-medium"><i class="fas fa-user"></i>
                                Nama:</label>
                            <input type="text" id="name" name="name"
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block mb-2 font-medium"><i class="fas fa-envelope"></i>
                                Email:</label>
                            <input type="email" id="email" name="email"
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block mb-2 font-medium"><i class="fas fa-comment"></i>
                                Pesan:</label>
                            <textarea id="message" name="message" rows="5"
                                class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-green-500" required></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-green-700 text-white py-2 rounded-md hover:bg-green-800 transition duration-300"><i
                                class="fas fa-paper-plane"></i> Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
