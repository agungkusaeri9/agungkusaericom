@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Galeri Proyek</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.projects.index') }}">Proyek</a></div>
                <div class="breadcrumb-item">Galeri Proyek</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Nama Proyek</span>
                                    <span class="ml-5 text-right">{{ $item->name }}</span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Kategori</span>
                                    <span class="ml-5 text-right">{{ $item->category->name ?? '-' }}</span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Tag</span>
                                    <span class="ml-5 text-right">
                                        @foreach ($item->tags as $tag)
                                            <span class="badge badge-info mb-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </span>
                                </li>
                                <hr>

                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Meta Keyword</span>
                                    <span class="ml-5 text-right">{{ $item->meta_keyword }}</span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Meta Deskripsi</span>
                                    <span class="ml-5 text-right">{{ $item->meta_description }}</span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Status</span>
                                    <span class="ml-5 text-right">
                                        @if ($item->status === 'ON PROGRESS')
                                            <span class="badge badge-warning">ON PROGRESS</span>
                                        @elseif($item->status === 'SUCCESS')
                                            <span class="badge badge-success">SUCCESS</span>
                                        @elseif($item->status === 'PENDING')
                                            <span class="badge badge-warning">PENDING</span>
                                        @else
                                            <span class="badge badge-danger">FAILED</span>
                                        @endif
                                    </span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Publikasikan</span>
                                    <span class="ml-5 text-right">
                                        @if ($item->is_publish == true)
                                            <span class="badge badge-success">Ya</span>
                                        @else
                                            <span class="badge badge-danger">Tidak</span>
                                        @endif
                                    </span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Dibuat</span>
                                    <span
                                        class="ml-5 text-right">{{ $item->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h6 class="text-center">Galeri Proyek</h6>
                            <a href="javascript:void(0)" class="btnAddPhoto btn btn-primary btn-sm">Tambah Gambar</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($item->galleries as $gallery)
                                <div class="col-md-3">
                                    <img src="{{ $gallery->image() }}" alt="{{ $item->name }}" class="img-thumbnail mb-3 btnImg" data-src="{{ $gallery->image() }}" data-id="{{ $gallery->id }}">
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="text-center">
                                        Galeri Masih Kosong!
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content ">
            <div class="modal-header">
                <div class="modal-title">Gambar</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" class="img-fluid modal-image" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Gambar Proyek</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <img src="" id="modalImg" class="img-fluid w-100">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="#" method="post" id="formDelete">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="modalAddPhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Tambah Gambar Proyek</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.projects.galleries.store',$item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $item->id }}" name="project_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
          </div>
        </div>
    </div>
@endsection
<x-Admin.Sweetalert />
@push('styles')
    <style>
        .btnImg{
            max-height: 120px
        }
    </style>
@endpush
@push('scripts')
<script>
    $('body').on('click','.btnImg', function(){
        console.log('ok');
        var src = $(this).data('src');
        $('#modalImg').attr('src',src);
        var id = $(this).data('id');
        var action = '{{ url('admin/projects') }}' + '/' + id + '/gallery/delete';
        $('#formDelete').attr('action',action);
        $('#myModal').modal('show');
    })

    $('.btnAddPhoto').on('click', function(){
        $('#modalAddPhoto').modal('show');
    })
    $('.image').on('click', function(){
        let image = $(this).data('image');
        $('#myModal2 .modal-image').attr('src',image);
        $('#myModal2').modal('show');
    })
</script>
@endpush
