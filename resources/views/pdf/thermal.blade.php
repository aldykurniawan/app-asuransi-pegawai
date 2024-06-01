<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
    <style>
        @page {
            margin: 0px;
        }

        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            font-size: 9px;
            padding: 0;
        }

        h2 {
            margin: 0;
            padding: 0;
            font-size: 10px;
        }

        .header {
            text-align: center;
            font-size: 10px;
            margin-bottom: 20px;
        }

        .item {
            margin-bottom: 5px;
            font-size: 7px;
            padding: 3px 0px;
        }

        .total {
            font-weight: bold;
            margin-top: 5px;
            font-size: 10px !important;
            text-align: right;
        }
        .detail-lebih {
            font-size: 8px !important;
            font-weight: 100;
            color: #080808;
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 6px;
            font-style: italic;
        }
        .container {
            padding: 10px;
            margin: 0;/* Sesuaikan dengan lebar kertas printer thermal */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SIMATAMart</h1>
            <div style="font-size: 10px;">
                No. Transaksi: {{ $kodeTransaksi }}
            </div>
        </div>
        <div class="content">
            @foreach ($items as $item)
                <div class="item">
                    {{ $item['nama'] }} <br>
                    > {{ $item['harga'] }} x {{ $item['qty'] }} Item =
                    Rp. {{ number_format($item['total'], 0, ',', '.') }}
                </div>
            @endforeach
            <div class="total">
                Total Bayar: Rp {{ number_format($totalBayar, 0, ',', '.') }}
            </div>
            <div class="detail-lebih">
                Kembalian: Rp {{ number_format($kembalian, 0, ',', '.') }} <br>
                Bayar: Rp {{ number_format($totalDibayar, 0, ',', '.') }} <br>
                Tanggal Transaksi: {{ $tanggalTransaksi }} <br>
                Kasir: {{ $kasir }} <br>
                Metode Pembayaran: {{ $metodePembayaran }}
            </div>
        </div>
        <div class="footer">
            {{ $pesanPenutup }}
        </div>
    </div>
</body>

</html>
