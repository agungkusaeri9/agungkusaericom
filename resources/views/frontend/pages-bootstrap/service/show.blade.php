@extends('frontend.layouts.app')
@section('content')
<section class="banner_area w-100">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>{{ $item->name }}</h2>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{javascript:void(0)">Services</a>
                    <a href="{javascript:void(0)">{{ $item->name }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
   {!! $item->content !!}
@endsection

@push('styles')
{!! $item->head !!}
@endpush
@push('scripts')
{!! $item->script !!}
@endpush
