<x-app-layout>
    <div class="main-content" style="flex: 1; padding: 20px;">
        <div class="greeting"
            style="margin-top: 20px; display: flex; justify-content: space-between; align-items: center; background-color: #ffffff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px;">
            <div>
                <h1 id="greeting-text" style="font-size: 1.5rem; font-weight: bold; color: #333333;"></h1>
                <p id="date-text" style="color: #000000;"></p>
                <p style="color: #666666;">Laporan bulan ini</p>
            </div>
            <img src="{{ asset('images/ilustration.png') }}" alt="Illustration" style="width: 100px; height: auto;">
        </div>
        <div class="chart-container"
            style="margin-top: 20px; background-color: #ffffff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px;
                    max-height: 350px;">
            <h2 style="font-size: 1.3rem; font-weight: bold; color: #333333; margin-bottom: 10px;">Grafik Statistik
                Bulan {{ $monthName }} {{ $currentYear }}</h2>
            <canvas id="myChart" width="800" height="200"></canvas>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Surat Pernyataan Ganti Rugi Tanah', 'Surat Hibah', 'Surat Keterangan Pendaftaran Tanah',
                    'Pengajuan Permohonan', 'Pengguna SITARA'
                ],
                datasets: [{
                    data: [{{ $spgr }}, {{ $surathibah }}, {{ $skpt }},
                        {{ $pengajuan }}, {{ $userCount }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
