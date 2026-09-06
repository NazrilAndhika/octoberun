<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-black text-gray-900 tracking-tight mb-8">Dashboard Utama</h1>

    <!-- Kotak-kotak Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        <!-- Total Pendaftar -->
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 shadow-sm flex flex-col justify-center transition hover:-translate-y-1">
            <span class="text-sm font-bold text-blue-600 mb-1 uppercase tracking-wider">Total Pendaftar (Aktif)</span>
            <span class="text-4xl font-black text-[#0b4d75]">{{ $totalPendaftar }}</span>
        </div>
        
        <!-- Lunas -->
        <div class="bg-green-50 border border-green-100 rounded-xl p-6 shadow-sm flex flex-col justify-center transition hover:-translate-y-1">
            <span class="text-sm font-bold text-green-600 mb-1 uppercase tracking-wider">Sudah Lunas</span>
            <span class="text-4xl font-black text-green-700">{{ $lunas }}</span>
        </div>
        
        <!-- Pending -->
        <div class="bg-orange-50 border border-orange-100 rounded-xl p-6 shadow-sm flex flex-col justify-center transition hover:-translate-y-1">
            <span class="text-sm font-bold text-orange-600 mb-1 uppercase tracking-wider">Masih Pending</span>
            <span class="text-4xl font-black text-orange-700">{{ $pending }}</span>
        </div>
        
        <!-- Kadaluarsa -->
        <div class="bg-red-50 border border-red-100 rounded-xl p-6 shadow-sm flex flex-col justify-center transition hover:-translate-y-1">
            <span class="text-sm font-bold text-red-600 mb-1 uppercase tracking-wider">Kadaluarsa (Auto)</span>
            <span class="text-4xl font-black text-red-700">{{ $expired ?? 0 }}</span>
        </div>

        <!-- Sisa Kuota -->
        <div class="bg-purple-50 border border-purple-100 rounded-xl p-6 shadow-sm flex flex-col justify-center transition hover:-translate-y-1">
            <span class="text-sm font-bold text-purple-600 mb-1 uppercase tracking-wider">Sisa Kuota</span>
            <div class="flex items-baseline gap-2">
                <span class="text-4xl font-black text-purple-700">{{ $sisaKuota < 0 ? 0 : $sisaKuota }}</span>
                <span class="text-sm font-bold text-purple-400">/ {{ $kuotaTotal }}</span>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-6 shadow-sm flex flex-col justify-center transition hover:-translate-y-1">
            <span class="text-sm font-bold text-indigo-600 mb-1 uppercase tracking-wider">Total Pendapatan</span>
            <span class="text-2xl font-black text-indigo-700 mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Area Grafik Analitik -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden mb-8 p-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Grafik Pendapatan Bulanan ({{ $selectedYear }})</h2>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <label for="year" class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Filter Tahun:</label>
                <select name="year" id="year" onchange="this.form.submit()" class="border-gray-300 rounded-lg shadow-sm focus:ring-[#0b4d75] focus:border-[#0b4d75] py-1.5 px-3 text-sm text-gray-700 font-bold">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="relative h-[300px] w-full">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>

    <!-- Area Tabel Ringkasan -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        
        <!-- Header Tabel -->
        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">{{ count($recentParticipants) }} Pendaftar Terbaru</h2>
            <!-- Link menuju halaman Data Pendaftar buatan Annisa -->
            <a href="{{ url('/admin-gsc/datapendaftar') }}" class="text-xs font-bold text-[#e85d04] hover:text-orange-700 hover:underline flex items-center gap-1">
                Lihat Semua Data
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </a>
        </div>
        
        <!-- Isi Tabel -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-100 text-xs text-gray-400 uppercase tracking-wider">
                        <th class="py-4 px-6 font-semibold">Nama Peserta</th>
                        <th class="py-4 px-6 font-semibold">Email</th>
                        <th class="py-4 px-6 font-semibold">Size Jersey</th>
                        <th class="py-4 px-6 font-semibold">Status</th>
                        <th class="py-4 px-6 font-semibold text-right">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700 divide-y divide-gray-100">
                    @forelse($recentParticipants as $p)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-bold text-[#0b4d75]">{{ $p->full_name }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ $p->email }}</td>
                        <td class="py-4 px-6">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded font-bold text-xs">
                                {{ $p->jersey_size }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $statusConfig = [
                                    'paid'    => ['label' => 'Lunas',   'class' => 'bg-green-100 text-green-700 border border-green-200'],
                                    'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700 border border-amber-200'],
                                    'failed'  => ['label' => 'Gagal',   'class' => 'bg-red-100 text-red-700 border border-red-200'],
                                    'expired' => ['label' => 'Expired', 'class' => 'bg-gray-100 text-gray-600 border border-gray-200'],
                                ];
                                $cfg = $statusConfig[$p->payment_status] ?? ['label' => ucfirst($p->payment_status ?? 'Pending'), 'class' => 'bg-gray-100 text-gray-600'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $cfg['class'] }}">
                                {{ $cfg['label'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right text-gray-400 text-xs font-semibold">
                            {{ $p->created_at->format('d M Y - H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-gray-400 font-semibold">
                            Belum ada pendaftar yang masuk ke sistem.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js CDN & Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('incomeChart').getContext('2d');
            var chartData = @json($monthlyIncomeData);
            
            var incomeChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Total Pendapatan (Rp)',
                        data: chartData,
                        backgroundColor: '#0b4d75',
                        hoverBackgroundColor: '#e85d04',
                        borderRadius: 4,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000) + ' Jt';
                                    }
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return ' Pendapatan: Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection