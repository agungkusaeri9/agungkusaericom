@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan SEO</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan SEO</div>
            </div>
        </div>
        <div class="section-body">
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
                                            <th>Gambar</th>
                                            <th>Halaman</th>
                                            <th>Judul</th>
                                            <th>Keyword</th>
                                            <th>Description</th>
                                            <th>URL</th>
                                            <th>Site Name</th>
                                            <th>Published</th>
                                            <th>Modified</th>
                                            <th>Robots</th>
                                            <th>Author</th>
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
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="halaman">Halaman</label>
                            <input type="text" class="form-control" name="halaman" id="halaman">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">Meta Keyword</label>
                            <input type="text" class="form-control" name="meta_keyword" id="meta_keyword">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Deskripsi</label>
                            <textarea name="meta_description" id="meta_description" cols="30" rows="3" class="form-control"
                                style="min-height: 120px"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="url">Url</label>
                            <input type="text" class="form-control" name="url" id="url">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="site_name">Site Name</label>
                            <input type="text" class="form-control" name="site_name" id="site_name">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="published_time">Published Time</label>
                            <input type="datetime-local" class="form-control" name="published_time" id="published_time">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="modified_time">Modified Time</label>
                            <input type="datetime-local" class="form-control" name="modified_time" id="modified_time">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class='form-group'>
                            <label for='robots'>Robots</label>
                            <select name='robots' id='robots' class='form-control'>
                                <option value='index' selected>Index</option>
                                <option value='noindex'>No Index</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author" id="author">
                            <div class="invalid-feedback"></div>
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
                ajax: '{{ route('admin.pengaturan-seo.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'halaman',
                        name: 'halaman'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'meta_keyword',
                        name: 'meta_keyword'
                    },
                    {
                        data: 'meta_description',
                        name: 'meta_description'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'site_name',
                        name: 'site_name'
                    },
                    {
                        data: 'published',
                        name: 'published'
                    },
                    {
                        data: 'modified',
                        name: 'modified'
                    },
                    {
                        data: 'robots',
                        name: 'robots'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('.btnAdd').on('click', function() {
                let types = ['Novice', 'Advance Beginner', 'Competent', 'Proficient', 'Expert'];
                $('#type').empty();
                types.forEach(type => {
                    $('#type').append(`<option value="${type}">${type}</option>`);
                });
                $('#myModal .modal-title').text('Tambah Data');
                $('#myModal').modal('show');
            })
            $('#myModal #myForm').on('submit', function(e) {
                e.preventDefault();
                // let form = $('#myModal #myForm');
                let form = new FormData(this);
                $.ajax({
                    url: '{{ route('admin.pengaturan-seo.store') }}',
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

            let getPengaturanSeo = function(id, callback) {
                $.ajax({
                    url: '{{ route('admin.pengaturan-seo.getByIdJson') }}',
                    data: {
                        id
                    },
                    dataType: 'JSON',
                    type: 'GET',
                    success: function(response) {
                        callback(response, true);
                        console.log(response);
                    },
                    error: function(err) {
                        callback(err, false);
                        console.log(err);
                    }
                })
            }

            $('body').on('click', '.btnEdit', function() {
                let id = $(this).data('id');

                getPengaturanSeo(id, function(data, success) {
                    if (success) {
                        let pengaturan = data.data;
                        $('#myForm #id').val(pengaturan.id);
                        $('#myForm #halaman').val(pengaturan.halaman);
                        $('#myForm #judul').val(pengaturan.judul);
                        $('#myForm #meta_keyword').val(pengaturan.meta_keyword);
                        $('#myForm #meta_description').val(pengaturan.meta_description);
                        $('#myForm #url').val(pengaturan.url);
                        $('#myForm #site_name').val(pengaturan.site_name);
                        $('#myForm #published_time').val(pengaturan.published);
                        $('#myForm #modified_time').val(pengaturan.modified);
                        $('#myForm #author').val(pengaturan.author);
                        let robotss = ['index', 'noindex'];
                        $('#robots').empty();
                        robotss.forEach(robot => {
                            if (robots === robot) {
                                $('#robots').append(
                                    `<option selected value="${robot}">${robot}</option>`
                                );
                            } else {
                                $('#robots').append(
                                    `<option value="${robot}">${robot}</option>`);
                            }
                        });
                        $('#myModal .modal-title').text('Edit Data');
                        $('#myModal').modal('show');
                    }
                })
            })
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let name = $(this).data('name');
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
                            url: '{{ url('admin/skills/') }}' + '/' + id,
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
