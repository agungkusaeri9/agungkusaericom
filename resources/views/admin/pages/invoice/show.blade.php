@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.invoices.index') }}">Data  Invoice</a></div>
                <div class="breadcrumb-item">{{ $item->code }}</div>
            </div>
        </div>

        <div class="section-body">
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
                                <div class="col-md-6">
                                    <address>
                                        <strong>Penyedia Jasa:</strong><br>
                                        {{ $setting->invoice_name }}<br>
                                        {{ $setting->invoice_phone_number }}<br>
                                        {{ $setting->invoice_email }}<br>
                                        {{ $setting->invoice_address }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
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
                                        {{$item->created_at->translatedFormat('d F Y H:i:s') }}<br><br>
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
                                        <th data-width="40">#</th>
                                        <th style="width:450px">Deskripsi</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                   @foreach ($item->details as $detail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $detail->description }}</td>
                                        <td class="text-right">Rp. {{ number_format($detail->price,0,',','.')  }}</td>
                                        <td class="text-center">{{ $detail->qty }}</td>
                                        <td class="text-right">Rp. {{ number_format($detail->total,0,',','.') }}</td>
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
                                              {{ $item->payment->name . ' | ' . $item->payment->number . ' | ' . $item->payment->description }}
                                              @else
                                              {{ $item->payment->name}}
                                              @endif
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <strong>Status</strong><br>
                                            {!! $item->status() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">Rp. {{ number_format($item->sub_total,0,',','.')  }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Diskon</div>
                                        <div class="invoice-detail-value">Rp. {{ number_format($item->discount,0,',','.')  }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">Rp. {{ number_format($item->total,0,',','.')  }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <div class="float-lg-left mb-lg-0 mb-3">
                    </div>

                    <a target="_blank" href="{{ route('admin.invoices.export-pdf',$item->code) }}" class="btn btn-danger btn-icon icon-left"><i class="fas fa-file-pdf"></i> Export Pdf</a>
                </div>
            </div>
        </div>
    </section>
@endsection
