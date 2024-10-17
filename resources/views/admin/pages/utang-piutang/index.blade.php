@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Utang Piutang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Utang Piutang</div>
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
                                        <div class="form-group">
                                            <label for="jenis">Pilih Jenis</label>
                                            <select name="jenis" id="jenis" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="utang">Utang</option>
                                                <option value="piutang">Piutang</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="status">Pilih Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="belum">Belum Lunas</option>
                                                <option value="lunas">Lunas</option>
                                            </select>
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
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>keterangan</th>
                                            <th>kepada</th>
                                            <th>Tanggal Jatuh Tempo</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" method="post" id="myForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="number" id="id" name="id" hidden>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <select name="jenis" id="jenis" class="form-control">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="kepada">Kepada</label>
                            <input type="text" class="form-control" name="kepada" id="kepada">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control"
                                style="min-height: 120px"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                            <input type="date" class="form-control" name="tanggal_jatuh_tempo"
                                id="tanggal_jatuh_tempo">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                    url: '{{ route('admin.utang-piutang.data') }}',
                    data: function(d) {
                        d.status = $('#filter #status').val();
                        d.jenis = $('#filter #jenis').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'kepada',
                        name: 'kepada'
                    },
                    {
                        data: 'tanggal_jatuh_tempo',
                        name: 'tanggal_jatuh_tempo'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
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
                ],
                drawCallback: function() {
                    var api = this.api();
                    // Total semua jumlah utang (seluruh data, termasuk yang tidak terlihat)
                    let totalNumber = 0;
                    var total = api.column(6).data().reduce(function(a, b) {
                        let tot = reformatRupiah(b);
                        let hasil = totalNumber = totalNumber + tot;
                        // console.log(tot);
                        return hasil;
                    }, 0);
                    // Update footer
                    $(api.column(6).footer()).html(formatRupiah(total));
                }
            });

            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/.{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + ribuan;
            }

            function reformatRupiah(value) {
                return parseFloat(value.replace(/[^0-9]/g, ""));
            }

            $('.btnFilter').on('click', function() {
                otable.draw();
            });

            $('.btnAdd').on('click', function() {
                let jenises = ['Utang', 'Piutang'];
                let statuses = [{
                        nomor: 0,
                        nama: 'Belum Lunas'
                    },
                    {
                        nomor: '1',
                        nama: 'Lunas'
                    },
                ];
                $('#myModal #jenis').empty();
                $('#myModal #status').empty();
                jenises.forEach(jenis => {
                    console.log(jenis);
                    $('#myModal #jenis').append(`<option value="${jenis}">${jenis}</option>`);
                });
                statuses.forEach(status => {
                    $('#myModal #status').append(
                        `<option value="${status.nomor}">${status.nama}</option>`);
                });
                $('#myModal .modal-title').text('Tambah Data');
                $('#myModal').modal('show');
            })
            $('#myModal #myForm').on('submit', function(e) {
                e.preventDefault();
                // let form = $('#myModal #myForm');
                let form = new FormData(this);
                $.ajax({
                    url: '{{ route('admin.utang-piutang.store') }}',
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

            let getUtangPiutang = function(id, callback) {
                $.ajax({
                    url: '{{ route('admin.utang-piutang.getById') }}',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.status) {
                            callback(response.data, true);
                        } else {
                            callback(null, false);

                        }
                    },
                    error: function(err) {
                        callback(null, false);
                    }
                })
            }

            $('body').on('click', '.btnEdit', function() {
                let id = $(this).data('id');
                getUtangPiutang(id, function(data, success) {
                    if (success) {
                        $('#myForm #jumlah').val(data.jumlah);
                        $('#myForm #keterangan').val(data.keterangan);
                        $('#myForm #kepada').val(data.kepada);
                        $('#myForm #tanggal').val(data.tanggal);
                        $('#myForm #tanggal_jatuh_tempo').val(data.tanggal_jatuh_tempo);
                        let jenises = ['Utang', 'Piutang'];
                        let statuses = [{
                                nomor: 0,
                                nama: 'Belum Lunas'
                            },
                            {
                                nomor: '1',
                                nama: 'Lunas'
                            },
                        ];
                        $('#myModal #jenis').empty();
                        $('#myModal #status').empty();
                        jenises.forEach(jenis => {
                            if (jenis == data.jenis) {
                                $('#myModal #jenis').append(
                                    `<option selected value="${jenis}">${jenis}</option>`
                                );
                            } else {
                                $('#myModal #jenis').append(
                                    `<option value="${jenis}">${jenis}</option>`);
                            }

                        });
                        statuses.forEach(status => {
                            if (status.nomor == data.status) {
                                $('#myModal #status').append(
                                    `<option selected value="${status.nomor}">${status.nama}</option>`
                                );
                            } else {
                                $('#myModal #status').append(
                                    `<option value="${status.nomor}">${status.nama}</option>`
                                );
                            }
                        });
                        $('#myForm #id').val(data.id);
                    }
                })

                $('#myModal .modal-title').text('Edit Data');
                $('#myModal').modal('show');
            })
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Yakin?',
                    text: `${name} akan dihapus dan tidak bisa dikembalikan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ url('admin/utang-piutang/') }}' + '/' + id,
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
