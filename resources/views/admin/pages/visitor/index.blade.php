@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Visitor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Visitor</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Filter</h5>
                            <form action="javascript:void(0)" method="get" id="filter">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class='form-group mb-3'>
                                            <label for='dari' class='mb-2'>Dari</label>
                                            <input type='date' name='dari' id='dari'
                                                class='form-control @error('dari') is-invalid @enderror' value=''>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="sampai">Sampai</label>
                                            <input type='date' name='sampai' id='sampai'
                                                class='form-control @error('sampai') is-invalid @enderror' value=''>
                                        </div>
                                    </div>
                                    <div class="col-md align-self-center">
                                        <button class="btn btn-sm px-2 btn-secondary py-2 btnFilter"><i
                                                class="fas fa-filter"></i>
                                            Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary mb-3 btnAdd"><i
                                    class="fas fa-plus"></i> Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table nowrap table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Method</th>
                                            <th>Request</th>
                                            <th>URL</th>
                                            <th>Referer</th>
                                            <th>Language</th>
                                            <th>User Agent</th>
                                            <th>Device</th>
                                            <th>Platform</th>
                                            <th>Browser</th>
                                            <th>IP</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<x-Admin.Datatable />
<x-Admin.Ajaxpost />
<x-Admin.Sweetalert />
@push('scripts')
    <script>
        $(function() {
            let otable = $('#dTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('admin.visitor.data') }}',
                    data: function(d) {
                        d.dari = $('#filter #dari').val();
                        d.sampai = $('#filter #sampai').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'method',
                        name: 'method'
                    },
                    {
                        data: 'request',
                        name: 'request'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'referer',
                        name: 'referer'
                    },
                    {
                        data: 'languages',
                        name: 'languages'
                    },
                    {
                        data: 'useragent',
                        name: 'useragent'
                    },
                    {
                        data: 'device',
                        name: 'device'
                    },
                    {
                        data: 'platform',
                        name: 'platform'
                    },
                    {
                        data: 'browser',
                        name: 'browser'
                    },
                    {
                        data: 'ip',
                        name: 'ip'
                    }
                ]
            });


            $('.btnFilter').on('click', function() {
                otable.draw();
            });
        })
    </script>
@endpush
