@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Invoice</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Data Invoice</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Filter</h5>
                            <form action="javascript:void(0)" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Pilih Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="paid">Paid</option>
                                                <option value="unpaid">Unpaid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md align-self-center">
                                        <button class="btn btn-sm px-2 btn-secondary py-2 btnFilter"><i class="fas fa-filter"></i>
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
                            <a href="{{ route('admin.invoices.create') }}" class="btn btn-sm btn-primary mb-3 btnAdd"><i
                                    class="fas fa-plus"></i> Buat Invoice</a>
                            <div class="table-responsive">
                                <table class="table nowrap table-striped table-hover" id="dTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Tanggal Dibayar</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Nomor Whatsapp</th>
                                            <th>Sub Total</th>
                                            <th>Diskon</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
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

            function swal(response) {
                if (response.status === 'error') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        text: response.message,
                        showConfirmButton: true,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: response.message,
                        showConfirmButton: true,
                        timer: 1500
                    })
                }
            }

            let otable = $('#dTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ route('admin.invoices.data') }}',
                    data: function(d) {
                        d.status = $('#status').val();
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
                        data: 'paid_time',
                        name: 'paid_time'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'sub_total',
                        name: 'sub_total'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('.btnFilter').on('click', function() {
                otable.draw();
            });

            $('.btnAdd').on('click', function() {
                $('#myModal .modal-title').text('Tambah Data');
                $('#myModal').modal('show');
            })
            $('#myModal #myForm').on('submit', function(e) {
                e.preventDefault();
                // let form = $('#myModal #myForm');
                let form = new FormData(this);
                $.ajax({
                    url: '{{ route('admin.invoices.store') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    data: form,
                    success: function(response) {
                        swal(response);
                        otable.ajax.reload();
                        $('#myModal').modal('hide');
                    },
                    error: function(response) {
                        let errors = response.responseJSON?.errors
                        $(form).find('.text-danger.text-small').remove()
                        if (errors) {
                            for (const [key, value] of Object.entries(errors)) {
                                $(`[name='${key}']`).parent().append(
                                    `<sp class="text-danger text-small">${value}</sp>`)
                                $(`[name='${key}']`).addClass('is-invalid')
                            }
                        }
                    }
                })
            })

            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let code = $(this).data('code');
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `${code} akan dihapus dan tidak bisa dikembalikan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('admin/invoices/') }}' + '/' + id,
                            type: 'DELETE',
                            dataType: 'JSON',
                            success: function(response) {
                                swal(response);
                                otable.ajax.reload();
                                $('#myModal').modal('hide');

                            },
                            error: function(response) {

                            }
                        })
                    }
                })
            })

            $('#myModal').on('hidden.bs.modal', function() {
                let form = $('#myModal #myForm');
                $(form).find('.text-danger.text-small').remove();
                $(form).find('.form-control').removeClass('is-invalid');
                form.trigger('reset');
            })

        })
    </script>
@endpush
