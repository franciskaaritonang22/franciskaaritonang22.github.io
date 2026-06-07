<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan - MAKECENTS</title>
    <style>
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #2d3748;
            line-height: 1.5;
        }
        .header {
            border-bottom: 2px solid #112d1e;
            padding-bottom: 20px;
            margin-bottom: 30px;
            position: relative;
        }
        .brand-name {
            font-size: 24px;
            font-weight: 800;
            color: #112d1e;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .report-title {
            font-size: 14px;
            color: #718096;
            margin: 5px 0 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .meta-info {
            position: absolute;
            top: 0;
            right: 0;
            text-align: right;
            font-size: 10px;
            color: #718096;
        }

        .stats-grid {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .stat-card {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            width: 23%;
            border-radius: 8px;
        }
        .stat-label {
            font-size: 9px;
            font-weight: bold;
            color: #a0aec0;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 14px;
            font-weight: bold;
            color: #1a202c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #112d1e;
            color: white;
            text-align: left;
            padding: 10px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #edf2f7;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .selesai { background-color: #def7ec; color: #03543f; }
        .pending { background-color: #fef3c7; color: #92400e; }
        .diproses { background-color: #e1effe; color: #1e429f; }
        .dibatalkan { background-color: #fde8e8; color: #9b1c1c; }

        .footer {
            margin-top: 50px;
            border-top: 1px solid #edf2f7;
            padding-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #a0aec0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1 class="brand-name">MAKECENTS COFFEE SPACE</h1>
        <p class="report-title">Laporan Analitik Penjualan</p>
        <div class="meta-info">
            Dicetak: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}<br>
            Oleh: {{ auth()->user()->name ?? 'Administrator' }}
        </div>
    </div>

    @if($request->filled('start_date') && $request->filled('end_date'))
    <div style="margin-bottom: 20px; font-weight: bold; font-size: 12px;">
        Periode: {{ \Carbon\Carbon::parse($request->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($request->end_date)->format('d M Y') }}
    </div>
    @endif

    <table class="stats-grid">
        <tr>
            <td class="stat-card" style="border-right: 10px solid white;">
                <div class="stat-label">Total Pendapatan</div>
                <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </td>
            <td class="stat-card" style="border-right: 10px solid white;">
                <div class="stat-label">Total Pesanan</div>
                <div class="stat-value">{{ $totalOrders }} Items</div>
            </td>
            <td class="stat-card" style="border-right: 10px solid white;">
                <div class="stat-label">Rata-rata Pesanan</div>
                <div class="stat-value">Rp {{ number_format($avgOrderValue, 0, ',', '.') }}</div>
            </td>
            <td class="stat-card">
                <div class="stat-label">Menunggu/Proses</div>
                <div class="stat-value">{{ $pendingCount }} Pesanan</div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">ID Order</th>
                <th style="width: 20%">Tanggal</th>
                <th style="width: 25%">Pelanggan</th>
                <th style="width: 20%">Total Harga</th>
                <th style="width: 15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $index => $o)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="font-weight: bold;">#{{ $o->kode_order ?? $o->id }}</td>
                <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $o->user->name ?? 'Tamu' }}</td>
                <td style="font-weight: bold;">Rp {{ number_format($o->total_price, 0, ',', '.') }}</td>
                <td>
                    <span class="status-badge {{ strtolower($o->status) }}">
                        {{ $o->status }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: #a0aec0;">
                    Tidak ada data pesanan ditemukan untuk periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; {{ date('Y') }} MAKECENTS Coffee Space - Sistem Manajemen Cafe</p>
        <p>Laporan ini dihasilkan secara otomatis oleh sistem.</p>
    </div>

</body>
</html>
