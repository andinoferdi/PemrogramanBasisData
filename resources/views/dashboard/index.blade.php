@extends('dashboard.layouts.main')

@section('content')
    <div class="container-fluid py-4">
        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Barang</h6>
                            <h4 class="font-weight-bold">{{ $barangCount }}</h4>
                        </div>
                        <i class="fas fa-box fa-2x text-primary"></i>
                    </div>
                    <a href="{{ route('barang.index') }}" class="card-footer text-primary text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Vendor</h6>
                            <h4 class="font-weight-bold">{{ $vendorCount }}</h4>
                        </div>
                        <i class="fas fa-store fa-2x text-success"></i>
                    </div>
                    <a href="{{ route('vendor.index') }}" class="card-footer text-success text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total User</h6>
                            <h4 class="font-weight-bold">{{ $userCount }}</h4>
                        </div>
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                    <a href="{{ route('user.index') }}" class="card-footer text-info text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card card-stats border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Total Pengadaan</h6>
                            <h4 class="font-weight-bold">{{ $pengadaanCount }}</h4>
                        </div>
                        <i class="fas fa-clipboard-list fa-2x text-warning"></i>
                    </div>
                    <a href="{{ route('pengadaan.index') }}" class="card-footer text-warning text-decoration-none">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-4">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="text-center mb-0 mt-7">Grafik Penjualan Bulanan</h5>
                    </div>

                    <div class="card-body">
                        <canvas id="penjualanChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="text-center mb-0 mt-7">Grafik Penerimaan dan Retur</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="penerimaanReturChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const penjualanData = {!! json_encode($penjualanData) !!};
        const penjualanLabels = penjualanData.map(data => `Bulan ${data.month}`);
        const penjualanValues = penjualanData.map(data => data.total);

        new Chart(document.getElementById('penjualanChart'), {
            type: 'bar',
            data: {
                labels: penjualanLabels,
                datasets: [{
                    label: 'Total Penjualan',
                    data: penjualanValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });

        const penerimaanCount = {{ $penerimaanCount }};
        const returCount = {{ $returCount }};

        new Chart(document.getElementById('penerimaanReturChart'), {
            type: 'doughnut',
            data: {
                labels: ['Penerimaan', 'Retur'],
                datasets: [{
                    label: 'Jumlah',
                    data: [penerimaanCount, returCount],
                    backgroundColor: ['#28a745', '#dc3545'],
                    borderColor: ['#28a745', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    </script>
@endsection
