@extends('livewire.website.layouts.app')

@section('content')
    <main>
        <!-- section -->
        <div class="mt-4">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('blogs') }}">Blog</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog Category</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


<!-- Blog Section start-->

@include('livewire.website.section.blogs')
<!-- Blog Section end-->
    </main>
@endsection
