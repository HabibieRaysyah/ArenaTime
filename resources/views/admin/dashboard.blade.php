@extends('admin.template.app')

@push('style')
    <style>
        /* Content Area */
        .content {
            padding: 30px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--surface);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.booking {
            border-left-color: var(--primary);
        }

        .stat-card.revenue {
            border-left-color: var(--success);
        }

        .stat-card.users {
            border-left-color: var(--secondary);
        }

        .stat-card.courts {
            border-left-color: var(--accent);
        }

        .stat-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .stat-icon.booking {
            background: var(--primary);
        }

        .stat-icon.revenue {
            background: var(--success);
        }

        .stat-icon.users {
            background: var(--secondary);
        }

        .stat-icon.courts {
            background: var(--accent);
        }

        .stat-info {
            flex: 1;
            margin-left: 15px;
        }

        .stat-title {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            margin: 5px 0;
        }

        .stat-change {
            font-size: 12px;
            font-weight: 600;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--error);
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: var(--surface);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        /* Recent Activity */
        .activity-card {
            background: var(--surface);
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
        }

        .activity-icon.booking {
            background: var(--primary);
        }

        .activity-icon.payment {
            background: var(--success);
        }

        .activity-icon.user {
            background: var(--secondary);
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .activity-time {
            font-size: 12px;
            color: var(--text-light);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .action-btn {
            background: var(--surface);
            border: 2px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text);
        }

        .action-btn:hover {
            border-color: var(--primary);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            background: var(--surface-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 20px;
            color: var(--primary);
        }

        .action-text {
            font-weight: 600;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--surface-light);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 2px;
        }
    </style>
@endpush

@section('content')
    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card booking">
            <div class="stat-header">
                <div class="stat-icon booking">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-title">Total Booking</div>
                    <div class="stat-value">1,247</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card revenue">
            <div class="stat-header">
                <div class="stat-icon revenue">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-title">Pendapatan</div>
                    <div class="stat-value">Rp 28.5Jt</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card users">
            <div class="stat-header">
                <div class="stat-icon users">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-title">Member Aktif</div>
                    <div class="stat-value">856</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i> 5% baru
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card courts">
            <div class="stat-header">
                <div class="stat-icon courts">
                    <i class="fas fa-court-sport"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-title">Lapangan Tersedia</div>
                    <div class="stat-value">24</div>
                    <div class="stat-change positive">
                        <i class="fas fa-check"></i> Semua aktif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="#" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div class="action-text">Tambah Booking</div>
        </a>
        <a href="#" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="action-text">Tambah Member</div>
        </a>
        <a href="#" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-court-sport"></i>
            </div>
            <div class="action-text">Kelola Lapangan</div>
        </a>
        <a href="#" class="action-btn">
            <div class="action-icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <div class="action-text">Lihat Laporan</div>
        </a>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Statistik Booking Harian</h3>
                <select class="form-select" style="width: auto;">
                    <option>Minggu Ini</option>
                    <option>Bulan Ini</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div
                style="height: 300px; background: var(--surface-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                <canvas id="myChart-bar"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Jenis Olahraga Populer</h3>
            </div>
            <div
                style="height: 300px; background: var(--surface-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                [Chart: Pie Chart Olahraga]
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="activity-card">
        <div class="chart-header">
            <h3 class="chart-title">Aktivitas Terbaru</h3>
            <a href="#" class="text-primary">Lihat Semua</a>
        </div>
        <ul class="activity-list">
            <li class="activity-item">
                <div class="activity-icon booking">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">Booking baru untuk Lapangan Badminton #3</div>
                    <div class="activity-time">2 menit yang lalu</div>
                </div>
            </li>
            <li class="activity-item">
                <div class="activity-icon payment">
                    <i class="fas fa-money-check"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">Pembayaran berhasil dari Budi Santoso</div>
                    <div class="activity-time">15 menit yang lalu</div>
                </div>
            </li>
            <li class="activity-item">
                <div class="activity-icon user">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">Member baru bergabung: Sari Indah</div>
                    <div class="activity-time">1 jam yang lalu</div>
                </div>
            </li>
            <li class="activity-item">
                <div class="activity-icon booking">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-text">Booking dibatalkan untuk Lapangan Futsal #2</div>
                    <div class="activity-time">3 jam yang lalu</div>
                </div>
            </li>
        </ul>
    </div>
@endsection

@push('script')
    <script>
        let labelBar = [];
        let dataBar = [];
        $(function() {
            $.ajax({
                url: "{{ route('admin.chart') }}",
                method: "GET",
                success: function(response) {
                    labelBar = response.labels;
                    dataBar = response.data;
                    console.log(labelBar);
                    console.log(response.data);
                    chartBar(); // PENTING: render chart di sini
                },
                error: function(err) {
                    alert('Gagal mengambil data untuk chart Bar!');
                    console.error(err);
                }
            });
        });

        function chartBar() {
            const ctx = document.getElementById('myChart-bar');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelBar,
                    datasets: [{
                        label: "Penjualan Tiket Bulann",
                        data: dataBar,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            begintAtZero: true
                        }
                    },
                    responsive: true
                }
            });
        }
    </script>
@endpush
