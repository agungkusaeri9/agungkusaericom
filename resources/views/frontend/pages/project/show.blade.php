@extends('frontend.layouts.app')
@section('content')
    <section class="banner_area w-100">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>{{ $project->name }}</h2>
                    <div class="page_link">
                        <a href="{{ route('home') }}">Home</a>
                        <a href="{{ route('projects.index') }}">Projects</a>
                        <a href="javascript:void(0)">{{ $project->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Start Portfolio Details Area =================-->
    <section class="portfolio_details_area section_gap">
        <div class="container">
            <div class="portfolio_details_inner">
                <div class="row">
                    <div class="col-md-8">
                        <div class="left_img">
                            <img class="img-fluid" src="{{ $project->image() }}" alt="">
                        </div>
                        <div class="portfolio_right_text mt-30">
                            <h2 class="text-uppercase">{{ $project->name }}</h2>
                            <p>
                                {{ $project->meta_description }}
                            </p>
                            <ul class="list mb-5">
                                {{-- <li><span>Rating</span>: <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></li> --}}
                                {{-- <li><span>Client</span>: colorlib</li> --}}
                                <li><span>Website</span>:
                                    @if ($project->link)
                                        <a href="{{ $project->link }}">{{ $project->link }}</a>
                                    @else
                                        Unavailable
                                    @endif
                                </li>
                                <li><span>Created</span>: {{ $project->created_at->translatedFormat('d F Y') }}</li>
                            </ul>
                        </div>
                        {!! $project->description !!}
                    </div>
                    <div class="col-lg-4">
                        <x-Frontend.SidebarProjectRight />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Portfolio Details Area =================-->
@endsection
@push('styles')
    <style>
        .list li span {
            font-size: 12px;
            font-weight: normal;
        }

        .section_gap {
            padding: 100px 0 20px 0 !important;
        }

        .banner_area {
            background-image: none !important;
            min-height: 0 !important;
        }
    </style>
@endpush
