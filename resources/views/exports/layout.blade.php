{{-- Layout untuk preview cetak (dimuat di hidden iframe) --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Laporan PerpusKu')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 12px; color: #1e293b; }

        .header { text-align: center; border-bottom: 3px solid #4f46e5; padding-bottom: 12px; margin-bottom: 20px; }
        .header h1 { font-size: 20px; color: #4f46e5; }
        .header p { color: #64748b; font-size: 11px; margin-top: 4px; }
        .header .date { font-size: 10px; color: #94a3b8; margin-top: 6px; }

        .section-title { font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 10px; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background: #f1f5f9; color: #475569; font-weight: 600; text-align: left; padding: 8px 10px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        td { padding: 7px 10px; border-bottom: 1px solid #f1f5f9; font-size: 11px; }
        tr:nth-child(even) td { background: #fafbfc; }

        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: 600; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-error { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-primary { background: #e0e7ff; color: #3730a3; }
        .badge-default { background: #f1f5f9; color: #475569; }

        .stars { color: #f59e0b; }
        .footer { text-align: center; color: #94a3b8; font-size: 10px; margin-top: 20px; padding-top: 10px; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 PerpusKu</h1>
        <p>@yield('subtitle', 'Laporan Perpustakaan')</p>
        <div class="date">Dicetak pada: {{ now()->format('d M Y H:i') }}</div>
    </div>

    @yield('content')

    <div class="footer">
        PerpusKu — Sistem Perpustakaan Online | Laporan dicetak otomatis
    </div>
</body>
</html>
