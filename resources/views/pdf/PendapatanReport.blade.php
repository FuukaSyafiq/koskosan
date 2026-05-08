<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; color: #1a56db; }
        .header p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f3f4f6; color: #374151; font-weight: bold; text-align: left; padding: 12px; border: 1px solid #e5e7eb; }
        td { padding: 10px; border: 1px solid #e5e7eb; vertical-align: top; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .summary { margin-top: 30px; text-align: right; }
        .summary-box { display: inline-block; padding: 15px; border: 2px solid #10b981; border-radius: 8px; background-color: #ecfdf5; }
        .total-label { font-weight: bold; color: #065f46; }
        .total-amount { font-size: 1.2em; font-weight: bold; color: #047857; }
        .footer { margin-top: 50px; font-size: 0.8em; text-align: center; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENDAPATAN</h1>
        <p>Ayongekost Dashboard</p>
        @if($start_date && $end_date)
            <p>Periode: {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Transaksi ID</th>
                <th>Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalKeuntungan = 0; @endphp
            @foreach($records as $index => $record)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->tanggal)->translatedFormat('d M Y') }}</td>
                    <td>#{{ $record->transaksi_id }}</td>
                    <td>Rp {{ number_format($record->keuntungan, 0, ',', '.') }}</td>
                </tr>
                @php $totalKeuntungan += $record->keuntungan; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-box">
            <span class="total-label">TOTAL KEUNTUNGAN:</span>
            <span class="total-amount">Rp {{ number_format($totalKeuntungan, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y H:i') }}</p>
        <p>&copy; {{ date('Y') }} Ayongekost. Semua hak dilindungi.</p>
    </div>
</body>
</html>
