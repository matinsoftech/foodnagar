@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
@endsection
@section('content')
    <main>
        <!-- SINGLE BANNER PART START -->
        {{-- <section class="inner-section single-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-content">
                            <h2>Listing</h2>
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('listing') }}">All
                                        Listing</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- SINGLE BANNER PART END -->
        <!-- AD LIST PART START -->
        <section class="inner-section ad-list-part">
            <div class="container">
                <div class="row content-reverse">
                    @include('livewire.website.modules.listing.partials._ad-list-sidebar')
                    @include('livewire.website.modules.listing.partials._ad-list-content')
                </div>
            </div>
        </section>
        <!-- AD LIST PART END -->
    </main>
@endsection
