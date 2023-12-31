<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Calibri, Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        /* Penyesuaian agar mirip dengan Microsoft Excel */
        table {
            border-collapse: collapse;
            border-spacing: 0;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            font-size: 12px;
        }

        td {
            background-color: #ffffff;
        }

        .bulan,
        .tahun,
        .pendapatan {
            margin-bottom: 8px
        }

        .text-center {
            text-align: center
        }

        .text-left {
            text-align: left
        }

        .text-right {
            text-align: right
        }

        .bold {
            font-weight: bold
        }
    </style>
    <title>Laporan Invoice</title>
</head>

<body>

    <div>
        <h2>LAPORAN PENDAPATAN</h2>
    </div>

    @if (isset($month))
        <div class="bulan">
            Bulan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: {{ getMonthName($month) }}
        </div>
    @endif
    @if (isset($year))
        <div class="tahun">
            Tahun &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: {{ $year }}
        </div>
    @endif
    <div class="pendapatan">
        Pendapatan : {{ formatRupiah($items->sum('total')) }}
    </div>
    <table>
        <thead>
            <tr>
                <th width="10">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Nama Pemesan</th>
                <th class="text-center">Sub Total</th>
                <th class="text-center">Diskon</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->created_at->translatedFormat('H:i:s d/m/Y') }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-right">{{ formatRupiah($item->sub_total) }}</td>
                    <td class="text-right">{{ formatRupiah($item->discount ?? 0) }}</td>
                    <td class="text-right">{{ formatRupiah($item->total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-center bold">Jumlah</td>
                <td class="text-right bold">{{ formatRupiah($items->sum('discount')) }}</td>
                <td class="text-right bold">{{ formatRupiah($items->sum('total')) }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
