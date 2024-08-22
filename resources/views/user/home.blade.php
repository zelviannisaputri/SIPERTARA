<x-app-layout>
    <div class="main-content" style="flex: 1; padding: 20px;">
        <div class="greeting-card"
            style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; background-color: #ffffff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px;">
            <div class="greeting">
                <h1 id="greeting-text" style="font-size: 1.5rem; font-weight: bold; color: #333333;"></h1>
                <p id="date-text" style="color: #000000;"></p>
            </div>
            <div class="illustration">
                <img src="{{ asset('images/ilustration.png') }}" alt="Illustration" style="width: 100px; height: auto;">
            </div>
        </div>

        <div class="features" style="margin-top: 20px; display: flex; justify-content: space-between;">
            <a href="{{ route('pengajuanuser.index') }}" class="feature-box"
                style="width: 45%; padding: 15px; background-color: #11b981; border-radius: 8px; text-decoration: none; color: #f9f9f9; transition: background-color 0.3s ease;">
                <h2 style="font-size: 1.2rem; margin-bottom: 5px;">Pengajuan Baru</h2>
                <p style="font-size: 0.9rem; color: #f9f9f9;">Ajukan permohonan baru</p>
            </a>
            <a href="{{ route('riwayat.pengajuan') }}" class="feature-box"
                style="width: 45%; padding: 15px; background-color: #11b981; border-radius: 8px; text-decoration: none; color: #f9f9f9; transition: background-color 0.3s ease;">
                <h2 style="font-size: 1.2rem; margin-bottom: 5px;">Riwayat Pengajuan</h2>
                <p style="font-size: 0.9rem; color: #f9f9f9;">Lihat riwayat pengajuan Anda</p>
            </a>
        </div>
    </div>

    <style>
        .feature-box:hover {
            background-color: #e0e0e0;
        }
    </style>

    <script>
        function updateGreeting() {
            const greetingText = document.getElementById('greeting-text');
            const dateText = document.getElementById('date-text');
            const now = new Date();
            const hours = now.getHours();
            let greeting = 'Selamat ';

            if (hours < 12) {
                greeting += 'Pagi';
            } else if (hours < 15) {
                greeting += 'Siang';
            } else if (hours < 18) {
                greeting += 'Sore';
            } else {
                greeting += 'Malam';
            }
            greetingText.textContent = `${greeting}, {{ Auth::user()->name }}!`;

            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            const dayName = days[now.getDay()];
            const day = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            dateText.textContent = `${dayName}, ${day} ${monthName} ${year}`;
        }
        updateGreeting();
    </script>
        @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        </script>
    @endif
</x-app-layout>
