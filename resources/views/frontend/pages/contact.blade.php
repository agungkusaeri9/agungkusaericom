@extends('frontend.layouts.app')
@section('content')
<section class="banner_area w-100">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Contact Me</h2>
                <div class="page_link">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('contact.index') }}">Contact Me</a>
                </div>
            </div>
        </div>
    </div>
</section>
    <section class="contact_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>Address</h6>
                            <p>{{ $setting->address }}</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6>Phone </h6>
                            <p><a href="#" class="text-dark">{{ $setting->phone }}</a></p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6>Email</h6>
                            <p><a href="#" class="text-dark">{{ $setting->email }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form class="contact_form" action="{{ route('contact.store') }}" method="post" id="contactForm"
                        novalidate="novalidate">
                        @csrf
                        <div class='form-group mb-3'>
                            <input type='text' name='name' class='form-control @error('name') is-invalid @enderror'
                                value='{{ old('name') }}' placeholder="Enter Name">
                            @error('name')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <input type='email' name='email' class='form-control @error('email') is-invalid @enderror'
                                value='{{ old('email') }}' placeholder="Enter Email">
                            @error('email')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <input type='text' name='subject' class='form-control @error('subject') is-invalid @enderror'
                                value='{{ old('subject') }}' placeholder="Enter Subject">
                            @error('subject')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class='form-group mb-3'>
                            <textarea name='text' id='text' cols='30' rows='3'
                                class='form-control @error('text') is-invalid @enderror' placeholder="Enter Message">{{ old('text') }}</textarea>
                            @error('text')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-right">
                            <button type="submit" value="submit" class="primary_btn">
                                <span>Send Message</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <x-Frontend.alert />
@endsection

@push('styles')
    <style>
               .section_gap {
            padding: 100px 0 200px 0 !important;
        }

        .banner_area {
            background-image: none !important;
            min-height: 0 !important;
        }
    </style>
@endpush
