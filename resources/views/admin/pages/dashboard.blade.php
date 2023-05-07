@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Invoice</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['invoice'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total User</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['users'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Portofolio</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['portfolio'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Project</h4>
                        </div>
                        <div class="card-body">
                            {{ $count['project'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Invoice Tahun {{ Carbon\Carbon::now()->format('Y') }}</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Invoice Terbaru</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Nomor Hp</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $invoice->created_at->translatedFormat('H:i:s d-m-Y') }}</td>
                                                <td>{{ $invoice->code }}</td>
                                                <td>{{ $invoice->name }}</td>
                                                <td>{{ $invoice->phone_number }}</td>
                                                <td>Rp. {{ number_format($invoice->total, 0, '', '.') }}</td>
                                                <td>
                                                    @if ($invoice->status == 1)
                                                        <span class="badge badge-success">Paid</span>
                                                    @else
                                                        <span class="badge badge-danger">Unpaid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-Admin.Sweetalert />
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/chart.js/Chart.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        #myChart{
                height: 400px;
            }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let ajaxTransaction = function() {
            let dataTransaction;
            $.ajax({
                url: '{{ route('admin.ajaxTransaction') }}',
                type: 'POST',
                async: false,
                dateType: 'JSON',
                success: function(response) {
                    dataTransaction = response;
                },
                error: function(error) {
                    console.log(error);
                }
            })

            return dataTransaction;
        }

        let chartTransaction = ajaxTransaction();
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartTransaction[0],
                datasets: [{
                    data: chartTransaction[1],
                    backgroundColor: chartTransaction[3],
                    borderColor: chartTransaction[4],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(value, index, ticks) {
                                return "Rp. " + Number(value).toFixed(0).replace(/./g,
                                    function(c, i, a) {
                                        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ?
                                            "." + c : c;
                                    });
                            }
                        },

                    }],
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Rp. " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i,
                                a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                            });
                        }
                    }
                }
            }
        });
    </script>
@endpush
