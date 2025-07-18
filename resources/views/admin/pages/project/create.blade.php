@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Proyek</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.projects.index') }}">Proyek</a></div>
                <div class="breadcrumb-item">Tambah Proyek</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nama Proyek</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" id="name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="project_category_id">Kategori</label>
                                            <select name="project_category_id" id="project_category_id"
                                                class="form-control select2 @error('project_category_id') is-invalid @enderror">
                                                <option value="" selected disabled>Pilih Kategori</option>
                                                @foreach ($categories as $category)
                                                    <option @selected($category->id == old('project_category_id')) value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('project_category_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="project_tag_id">Tag <span>(Dapat memilih lebih dari 1
                                                    tag)</span></label>
                                            <select name="project_tag_id[]" id="project_tag_id"
                                                class="form-control select2 @error('project_tag_id') is-invalid @enderror"
                                                multiple>
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('project_tag_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keyword">Meta Keyword</label>
                                            <input type="text"
                                                class="form-control @error('meta_keyword') is-invalid @enderror"
                                                name="meta_keyword" value="{{ old('meta_keyword') }}" id="meta_keyword">
                                            @error('meta_keyword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="short_description">Deskripsi Singkat</label>
                                            <textarea name="short_description" id="short_description"
                                                class="form-control @error('short_description') is-invalid @enderror" cols="30" rows="5"
                                                style="min-height: 120px"></textarea>
                                            @error('short_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Deksripsi</label>
                                            <textarea name="meta_description" id="meta_description"
                                                class="form-control @error('meta_description') is-invalid @enderror" cols="30" rows="5"
                                                style="min-height: 120px"></textarea>
                                            @error('meta_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                                name="link" value="{{ old('link') }}" id="link">
                                            @error('link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option @selected(old('status') === 'ON PROGRESS') value="ON PROGRESS">ON PROGRESS
                                                </option>
                                                <option @selected(old('status') === 'SUCCESS') value="SUCCESS">SUCCESS</option>
                                                <option @selected(old('status') === 'PENDING') value="PENDING">PENDING</option>
                                                <option @selected(old('status') === 'FAILED') value="FAILED">FAILED</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="is_publish">Publikasikan</label>
                                            <select name="is_publish" id="is_publish"
                                                class="form-control @error('is_publish') is-invalid @enderror">
                                                <option value="" selected disabled>Pilih</option>
                                                <option @selected(old('is_publish') === '1') value="1">Ya</option>
                                                <option @selected(old('is_publish') === '0') value="0">Tidak</option>

                                            </select>
                                            @error('is_publish')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="is_portfolio">Set Portofolio</label>
                                            <select name="is_portfolio" id="is_portfolio"
                                                class="form-control @error('is_portfolio') is-invalid @enderror">
                                                <option value="" selected disabled>Pilih</option>
                                                <option @selected(old('is_portfolio') == 1) value="1">Ya</option>
                                                <option @selected(old('is_portfolio') == 0) value="0">Tidak</option>
                                            </select>
                                            @error('is_portfolio')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Gambar</label>
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                                                Tambah</button>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                cols="30" rows="5">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugin/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                tags: true
            });
            var options = {
                filebrowserImageBrowseUrl: '/filemanager',
                filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/filemanager?type=Files',
                filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
            };
            CKEDITOR.replace('description', options);
            CKEDITOR.addCss(".cke_editable{cursor:text; font-size: 16px; font-family: Arial, sans-serif;}");
            CKEDITOR.config.height = 500;
        })
    </script>
@endpush
