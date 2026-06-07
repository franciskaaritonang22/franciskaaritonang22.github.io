<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk - {{ $order->kode_order }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', monospace; max-width: 320px; margin: 0 auto; padding: 20px; color: #111; }
        .header { text-align: center; border-bottom: 2px dashed #ccc; padding-bottom: 16px; margin-bottom: 16px; }
        .header h1 { font-size: 22px; font-weight: 900; letter-spacing: -1px; }
        .header p { font-size: 11px; color: #666; margin-top: 4px; }
        .info { margin-bottom: 16px; font-size: 12px; }
        .info .row { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .info .row .label { color: #888; }
        .info .row .value { font-weight: 600; }
        .items { border-top: 1px dashed #ccc; border-bottom: 1px dashed #ccc; padding: 12px 0; margin-bottom: 12px; }
        .item { display: flex; justify-content: space-between; margin-bottom: 6px; font-size: 12px; }
        .item .name { flex: 1; }
        .item .qty { width: 40px; text-align: center; color: #888; }
        .item .price { width: 90px; text-align: right; font-weight: 600; }
        .total { display: flex; justify-content: space-between; font-size: 16px; font-weight: 700; margin: 12px 0; padding-top: 8px; border-top: 2px solid #111; }
        .footer { text-align: center; margin-top: 20px; padding-top: 16px; border-top: 2px dashed #ccc; }
        .footer p { font-size: 11px; color: #888; margin-bottom: 4px; }
        .footer .thanks { font-size: 13px; font-weight: 700; color: #111; margin-bottom: 4px; }
        @media print {
            body { max-width: 100%; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align:center;margin-bottom:20px;">
        <button onclick="window.print()" style="background:#111;color:white;border:none;padding:10px 30px;border-radius:10px;font-weight:700;cursor:pointer;font-size:13px;">🖨️ Cetak Struk</button>
    </div>

    <div class="header">
        <h1>MAKECENTS</h1>
        <p>Coffee Space</p>
        <p style="margin-top:8px;">{{ $order->created_at->format('d M Y, H:i') }}</p>
    </div>

    <div class="info">
        <div class="row">
            <span class="label">Pesanan</span>
            <span class="value">#{{ $order->kode_order }}</span>
        </div>
        <div class="row">
            <span class="label">Pelanggan</span>
            <span class="value">{{ $order->user->name ?? 'Tamu' }}</span>
        </div>
        <div class="row">
            <span class="label">Pembayaran</span>
            <span class="value">{{ strtoupper($order->payment_method ?? 'CASH') }}</span>
        </div>
        <div class="row">
            <span class="label">Status</span>
            <span class="value">{{ ucfirst($order->status) }}</span>
        </div>
    </div>

    <div class="items">
        @foreach($order->orderItems as $item)
        <div class="item">
            <span class="name">{{ $item->menu->name ?? 'Item' }}</span>
            <span class="qty">x{{ $item->qty }}</span>
            <span class="price">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
        </div>
        @endforeach
    </div>

    @php $tax = $order->total_price * 0.10; @endphp
    <div class="info">
        <div class="row">
            <span class="label">Subtotal</span>
            <span class="value">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
        <div class="row">
            <span class="label">Pajak (10%)</span>
            <span class="value">Rp {{ number_format($tax, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="total">
        <span>TOTAL</span>
        <span>Rp {{ number_format($order->total_price + $tax, 0, ',', '.') }}</span>
    </div>

    <div class="footer">
        <p class="thanks">Terima kasih atas pesanan Anda! ☕</p>
        <p>Powered by MAKECENTS Coffee Space</p>
    </div>
</body>
</html>