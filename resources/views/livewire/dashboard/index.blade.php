<div x-data="{ sidebarOpen: false }"
    x-on:toggle.window="sidebarOpen = !sidebarOpen"
    class="flex flex-col w-full transition-all duration-300"
    x-bind:class="sidebarOpen ? 'md:ml-[20%] md:w-[80%]' : 'ml-0'">

    <div class="flex-1 px-8 py-8 space-y-8">

        {{-- ── Section Title ── --}}
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900">Tinjauan Analitik</h2>
            <p class="text-sm text-gray-500 mt-1">Pantau performa armada dan metrik operasional utama hari ini.</p>
        </div>

        {{-- ── KPI Cards ── --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

            {{-- 1. Total Pengiriman --}}
            <div class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="14" rx="2"/>
                            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                        </svg>
                    </div>
                    @php $isUp = str_starts_with($shipmentPct, '+') || (float) $shipmentPct > 0; @endphp

                    <span class="inline-flex items-center gap-1 text-xs font-semibold px-2 py-0.5 rounded-full
                        {{ $isUp ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        @if ($isUp)
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/>
                                <polyline points="16 7 22 7 22 13"/>
                            </svg>
                        @else
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/>
                                <polyline points="16 17 22 17 22 11"/>
                            </svg>
                        @endif
                        {{ $shipmentPct }}
                    </span>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Pengiriman Bulanan vs Bulan Lalu</p>
                {{-- $totalPengiriman: int --}}
                <p class="text-3xl font-extrabold text-gray-900">{{ number_format($totalShipments) }} / {{ $lastMonth }}</p>
                <div class="mt-3 h-1.5 rounded-full bg-gray-100 overflow-hidden">
                    {{-- $pengirimanProgress: int 0–100 --}}
                    <div class="h-full bg-blue-600 rounded-full" style="width: {{ $shipmentProgress }}%"></div>
                </div>
            </div>

            {{-- 2. Truk Aktif --}}
            <div class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 3h15v13H1z"/><path d="M16 8h4l3 3v5h-7V8z"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                        </svg>
                    </div>
                    {{-- $trukUtilitas: string e.g. "85%" --}}
                    <span class="bg-blue-50 text-blue-700 border border-blue-100 text-xs font-semibold px-2 py-0.5 rounded-full">
                        {{ $truckUtilitiy }} Utilitas
                    </span>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Truk Aktif</p>
                <p class="text-3xl font-extrabold text-gray-900">
                    {{-- $trukAktif: int, $trukTotal: int --}}
                    {{ $truckInDelivery }}
                    <span class="text-lg font-semibold text-gray-400">/ {{ $totalTrucks }}</span>
                </p>
                {{-- $trukBars: int[] — 7 values 0–100, each is a percentage height --}}
                <div class="flex items-end gap-1 mt-3 h-8">
                    @foreach ($truckBars as $bar)
                        <div class="flex-1 rounded-sm {{ $loop->last ? 'bg-blue-600' : 'bg-blue-200' }}"
                             style="height: {{ $bar }}%"></div>
                    @endforeach
                </div>
            </div>

            {{-- 3. Kendala Hari Ini --}}
            <div class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                            <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></svg>
                        -2%
                    </span>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Kendala Hari Ini</p>
                <p class="text-3xl font-extrabold text-gray-900">{{ $totalReport }}</p>
                <p class="text-xs text-red-500 mt-3 font-medium">0 butuh perhatian segera</p>
            </div>

            {{-- 4. Total Revenue --}}
            <div class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="12" y1="1" x2="12" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                    </div>
                    <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                        Target: Rp 300M
                    </span>
                </div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Total Revenue</p>
                <p class="text-3xl font-extrabold text-gray-900">
                    Rp {{ number_format($revenue, 0, ',', '.') }}
                </p>
            </div>

        </div>{{-- /KPI Cards --}}

        {{-- ── Charts Row ── --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Weekly Delivery Line Chart --}}
            <div class="xl:col-span-2 bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">Performa Pengiriman Mingguan</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Volume pengiriman sukses 7 hari terakhir</p>
                    </div>
                    <select class="text-xs border border-gray-200 rounded-lg px-3 py-1.5 bg-gray-50 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-100 cursor-pointer">
                        <option>Minggu Ini</option>
                        <option>Minggu Lalu</option>
                        <option>Bulan Ini</option>
                    </select>
                </div>
                <div class="h-56">
                    <canvas id="deliveryChart"></canvas>
                </div>
            </div>

            {{-- Fleet Status Donut --}}
            <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 flex flex-col">
                <div class="mb-4">
                    <h3 class="text-base font-bold text-gray-900">Status Armada</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Distribusi unit saat ini</p>
                </div>
                <div class="flex-1 flex flex-col items-center justify-center gap-6">
                    <div class="relative w-44 h-44">
                        <canvas id="fleetChart"></canvas>
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <span class="text-3xl font-extrabold text-gray-900">{{ $totalTrucks }}</span>
                            <span class="text-xs text-gray-400 font-medium">Total Unit</span>
                        </div>
                    </div>
                    <ul class="w-full space-y-2.5 text-sm">
                        <li class="flex items-center justify-between">
                            <span class="flex items-center gap-2 text-gray-600">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 inline-block"></span>
                                Dalam Perjalanan
                            </span>
                            <span class="font-bold text-gray-800">{{ $truckInDelivery }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="flex items-center gap-2 text-gray-600">
                                <span class="w-2.5 h-2.5 rounded-full bg-green-400 inline-block"></span>
                                Tersedia
                            </span>
                            <span class="font-bold text-gray-800">{{ $truckAvailable }}</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>{{-- /Charts Row --}}

        {{-- ── Recent Activity Table ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 hover:shadow-lg transition-all duration-200 overflow-hidden">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-100">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Aktivitas Terbaru Armada</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Log status terkini dari lapangan</p>
                </div>
                <button class="text-sm font-semibold text-blue-600 border border-blue-200 rounded-xl px-4 py-1.5 hover:bg-blue-50 transition-colors duration-150">
                    Lihat Semua
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-xs font-semibold uppercase tracking-wider text-gray-400">
                            <th class="px-6 py-3 text-left">Unit ID</th>
                            <th class="px-6 py-3 text-left">Pengemudi</th>
                            <th class="px-6 py-3 text-left">Rute</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">

                        {{-- Row 1: Dalam Perjalanan --}}
                        <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 font-bold text-gray-800">TRK-4092</td>
                            <td class="px-6 py-4 text-gray-600">Budi Santoso</td>
                            <td class="px-6 py-4 text-gray-600">Jakarta → Bandung</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    Dalam Perjalanan
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">10 mnt lalu</td>
                        </tr>

                        {{-- Row 2: Selesai --}}
                        <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 font-bold text-gray-800">TRK-2811</td>
                            <td class="px-6 py-4 text-gray-600">Agus Setiawan</td>
                            <td class="px-6 py-4 text-gray-600">Surabaya → Semarang</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-green-50 text-green-700 border border-green-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Selesai
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">45 mnt lalu</td>
                        </tr>

                        {{-- Row 3: Tersedia --}}
                        <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 font-bold text-gray-800">TRK-5501</td>
                            <td class="px-6 py-4 text-gray-600">Hendra Wijaya</td>
                            <td class="px-6 py-4 text-gray-600">Depo Utama</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                    Tersedia
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">2 jam lalu</td>
                        </tr>

                        {{-- Row 4: Kendala Mesin --}}
                        <tr class="hover:bg-blue-50/30 transition-colors duration-150">
                            <td class="px-6 py-4 font-bold text-gray-800">TRK-1198</td>
                            <td class="px-6 py-4 text-gray-600">Doni Pratama</td>
                            <td class="px-6 py-4 text-gray-600">Tol Cipali KM 102</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-red-50 text-red-600 border border-red-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Kendala Mesin
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400">3 jam lalu</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>{{-- /Table --}}

    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Weekly Delivery Line Chart ──────────────────────────────
    const deliveryCtx = document.getElementById('deliveryChart').getContext('2d');
    const deliveryGradient = deliveryCtx.createLinearGradient(0, 0, 0, 220);
    deliveryGradient.addColorStop(0, 'rgba(37,99,235,0.15)');
    deliveryGradient.addColorStop(1, 'rgba(37,99,235,0)');

    new Chart(deliveryCtx, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                data: @json($chartData),
                borderColor: '#2563eb',
                borderWidth: 2.5,
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                fill: true,
                backgroundColor: deliveryGradient,
                tension: 0.35,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#9ca3af', font: { size: 12 } }
                },
                y: {
                    grid: { color: '#f3f4f6' },
                    ticks: { color: '#9ca3af', font: { size: 12 } },
                    beginAtZero: false
                }
            }
        }
    });

    // ── Fleet Status Donut ──────────────────────────────────────
    new Chart(document.getElementById('fleetChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Dalam Perjalanan', 'Tersedia'],
            datasets: [{
                data: @json($fleetChartData),
                backgroundColor: ['#2563eb', '#4ade80', '#facc15'],
                borderColor: '#ffffff',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '74%',
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index' }
            }
        }
    });

});
</script>
@endpush