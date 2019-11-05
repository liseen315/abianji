@extends('layouts.frontend')

@section('body')
    <section class="jumbotron">
        <div class="video">
            <div class="video-frame">
                <img src="{{ asset('assets/ocean/overlay-hero.png') }}" alt="Decorative image frame">
            </div>
            <div class="video-media">
                <video playsinline="" autoplay="" loop="" muted="" data-autoplay=""
                       poster="{{ asset('assets/ocean/ocean.png') }}">
                    <source src="{{ asset('assets/ocean/ocean.mp4') }}" type="video/mp4">
                    <source src="{{ asset('assets/ocean/ocean.ogv') }}" type="video/ogg">
                    <source src="{{ asset('assets/ocean/ocean.webm') }}" type="video/webm">
                    <p>Your user agent does not support the HTML5 Video element.</p>
                </video>
                <div class="video-overlay"></div>
            </div>
            <div class="video-inner text-center text-white">
                <h1><a href="{{ route('home.index') }}">{{ blog_config('site_name') }}</a></h1>
                <p>{{ blog_config('sub_title') }}</p>
            </div>
            <div class="video-learn-more">
                <a href="#landingpage" class="anchor"><i class="fe icon-mouse"></i></a>
            </div>
        </div>
    </section>
    <div id="landingpage">

    </div>
@endsection
