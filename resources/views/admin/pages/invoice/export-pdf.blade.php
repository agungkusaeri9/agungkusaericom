<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $title ?? 'Dashboard' }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/bs/css/bootstrap.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="invoice">
            <div class="invoice-print">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-title">
                            <h2>Invoice</h2>
                            <div class="invoice-number">Invoice #{{ $item->code }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <address>
                                    <strong>Penyedia Jasa:</strong><br>
                                    {{ $setting->invoice_name }}<br>
                                    {{ $setting->invoice_phone_number }}<br>
                                    {{ $setting->invoice_email }}<br>
                                    {{ $setting->invoice_address }}
                                </address>
                            </div>
                            <div class="col-6 col-md-6 text-md-right">
                                <address>
                                    <strong>Pemesan:</strong><br>
                                    {{ $item->name }}<br>
                                    {{ $item->phone_number }}<br>
                                    {{ $item->address }}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-md-right">
                                <address>
                                    <strong>Tanggal Pemesanan:</strong><br>
                                    {{ $item->created_at->translatedFormat('H:i:s d F Y') }}<br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-md">
                                <tr>
                                    <th data-width="40">No.</th>
                                    <th style="width:500px">Deskripsi</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-right">Total</th>
                                </tr>
                                @foreach ($item->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->description }}</td>
                                        <td class="text-right">Rp. {{ number_format($detail->price, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ $detail->qty }}</td>
                                        <td class="text-right">Rp. {{ number_format($detail->total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-8">
                                <div class="row mb-2 mt-3">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Metode Pembayaran:</strong><br>
                                            @if ($item->payment->number)
                                                {{ $item->payment->name . ' - ' . $item->payment->number . ' a.n ' . $item->payment->description }}
                                            @else
                                                {{ $item->payment->name }}
                                            @endif
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <strong>Status</strong><br>
                                        @if ($item->status == 1)
                                            Paid
                                        @else
                                            Unpaid
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Subtotal</div>
                                    <div class="invoice-detail-value">Rp.
                                        {{ number_format($item->sub_total, 0, ',', '.') }}</div>
                                </div>
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Diskon</div>
                                    <div class="invoice-detail-value">Rp.
                                        {{ number_format($item->discount, 0, ',', '.') }}</div>
                                </div>
                                <hr class="mt-2 mb-2">
                                <div class="invoice-detail-item">
                                    <div class="invoice-detail-name">Total</div>
                                    <div class="invoice-detail-value invoice-detail-value-lg">Rp.
                                        {{ number_format($item->total, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
