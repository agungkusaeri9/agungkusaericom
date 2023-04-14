@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan Web</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan Web</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pengaturan</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-inline">
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Nama Situs</span>
                                    <span class="ml-4 text-right">{{ $setting->site_name }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Email</span>
                                    <span class="ml-4 text-right">{{ $setting->email }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>No. HP</span>
                                    <span class="ml-4 text-right">{{ $setting->phone }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Alamat</span>
                                    <span class="ml-4 text-right">{{ $setting->address }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Meta Kata Kunci</span>
                                    <span class="ml-4 text-right">{{ $setting->meta_keyword }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Meta Deskripsi</span>
                                    <span class="ml-4 text-right">{{ $setting->meta_description }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Pemilik</span>
                                    <span class="ml-4 text-right">{{ $setting->author }}</span>
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Favicon</span>
                                    <img src="{{ $setting->favicon() }}" class="img-fluid" style="max-height: 50px"
                                        alt="">
                                </li>
                                <hr>
                                <li class="list-item-inline d-flex justify-content-between">
                                    <span>Gambar</span>
                                    <img src="{{ $setting->image() }}" class="img-fluid" style="max-height: 50px"
                                        alt="">
                                </li>
                                <hr>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form method="post" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Pengaturan</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_name">Nama Situs</label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                        value="{{ $setting->site_name }}" name="site_name">
                                    @error('site_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ $setting->email }}" name="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">No. HP</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ $setting->phone }}" name="phone">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="whatsapp_number">No. Whatsapp</label>
                                    <input type="text"
                                        class="form-control @error('whatsapp_number') is-invalid @enderror"
                                        value="{{ $setting->whatsapp_number }}" name="whatsapp_number">
                                    @error('whatsapp_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address" id="address" cols="30" rows="4"
                                        class="form-control @error('address') is-invalid @enderror" style="min-height: 120px">{{ $setting->address }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" cols="30" rows="4"
                                        class="form-control @error('description') is-invalid @enderror" style="min-height: 120px">{{ $setting->description }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Kata Kunci</label>
                                    <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror"
                                        value="{{ $setting->meta_keyword }}" name="meta_keyword">
                                    @error('meta_keyword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Deskripsi</label>
                                    <textarea name="meta_description" id="meta_description" cols="30" rows="4"
                                        class="form-control @error('meta_description') is-invalid @enderror" style="min-height: 120px">{{ $setting->meta_description }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="author">Pemilik</label>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror"
                                        value="{{ $setting->author }}" name="author">
                                    @error('author')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="author_image">Foto Pemilik</label>
                                    <input type="file" class="form-control @error('author_image') is-invalid @enderror"
                                        value="{{ $setting->author_image }}" name="author_image">
                                    @error('author_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="author_role">Role Pemilik</label>
                                    <input type="text" class="form-control @error('author_role') is-invalid @enderror"
                                        value="{{ $setting->author_role }}" name="author_role">
                                    @error('author_role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="author_description">Deskripsi Pemilik</label>
                                    <textarea name="author_description" id="author_description" cols="30" rows="4"
                                        class="form-control @error('author_description') is-invalid @enderror" style="min-height: 120px">{{ $setting->author_description }}</textarea>
                                    @error('author_description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cv">Upload CV</label>
                                    <input type="file" class="form-control @error('cv') is-invalid @enderror"
                                        name="cv">
                                    @error('cv')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="favicon">Favicon</label>
                                    <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                                        name="favicon">
                                    @error('favicon')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <hr>
                                <div class='form-group mb-3'>
                                    <label for='invoice_name' class='mb-2'>Invoice Name</label>
                                    <input type='text' name='invoice_name'
                                        class='form-control @error('invoice_name') is-invalid @enderror'
                                        value='{{ $setting->invoice_name ?? old('invoice_name') }}'>
                                    @error('invoice_name')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='invoice_phone_number' class='mb-2'>Invoice Phone Number</label>
                                    <input type='text' name='invoice_phone_number'
                                        class='form-control @error('invoice_phone_number') is-invalid @enderror'
                                        value='{{ $setting->invoice_phone_number ?? old('invoice_phone_number') }}'>
                                    @error('invoice_phone_number')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='invoice_email' class='mb-2'>Invoice Email</label>
                                    <input type='text' name='invoice_email'
                                        class='form-control @error('invoice_email') is-invalid @enderror'
                                        value='{{ $setting->invoice_email ?? old('invoice_email') }}'>
                                    @error('invoice_email')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='invoice_address' class='mb-2'>Invoice Address</label>
                                    <textarea name='invoice_address' id='invoice_address' cols='30' rows='3'
                                        class='form-control @error('invoice_address') is-invalid @enderror'>{{ $setting->invoice_address ?? old('invoice_address') }}</textarea>
                                    @error('invoice_address')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<x-Admin.Sweetalert />
@push('scripts')
    <script src="{{ asset('assets/plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugin/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('description');
            CKEDITOR.addCss(".cke_editable{cursor:text; font-size: 14px; font-family: Arial, sans-serif;}");
            CKEDITOR.config.toolbar = [
                ['Bold', 'Italic', 'fontSize_sizes']
            ];
        })
    </script>
@endpush
