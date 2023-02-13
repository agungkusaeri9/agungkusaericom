@extends('admin.layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Proyek</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.projects.index') }}">Proyek</a></div>
                <div class="breadcrumb-item">Detail Proyek</div>
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
                                    <span class="ml-5 text-right">{{ $item->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
                                </li>
                                <hr>
                                <li class="list-item d-flex justify-content-between">
                                    <span class="font-weight-bold">Aksi</span>
                                    <span class="ml-5 text-right">
                                        <a href="{{ route('admin.projects.edit',$item->id) }}" class='btn btn-sm btn-info mx-1'><i class='fas fa fa-edit'></i> Edit</a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                           <div class="text-center">
                            <img src="{{ $item->image() }}" class="img-fluid postImage" alt="{{ $item->title }}">
                           </div>
                            <div class="description mt-4">
                                {!! $item->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('styles')
    <style>
        .postImage{
            max-height: 560px
        }
    </style>
@endpush
