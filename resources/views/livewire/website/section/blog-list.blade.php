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
                                <li class="breadcrumb-item active" aria-current="page">Blog List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- section -->
        <section class="mt-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <!-- heading -->
                        <h1 class="fw-bold">Blog List</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- section -->
        <section class="mb-lg-14 mb-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    @if (count($blogs) > 0)
                        @foreach ($blogs as $blog)
                            <!-- col -->
                            <div class="col-12 col-md-6 col-lg-4 mb-10">
                                <div class="mb-4">
                                    <a href="{{ route('read_blogs', $blog->id) }}">
                                        <!-- img -->
                                        <div class="img-zoom">
                                            <img src="{{ $blog->getFirstMediaUrl('images') }}" alt=""
                                                class="img-fluid w-100" style="height:166.75px" />
                                        </div>
                                    </a>
                                </div>
                                <div class="mb-3"><a
                                        href="{{ route('read_blogs', $blog->id) }}">{{ $blog->module->name }}</a></div>
                                <!-- text -->
                                <div>
                                    <h2 class="h5">
                                        <a href="{{ route('read_blogs', $blog->id) }}" class="text-inherit">
                                            {{ $blog->title }}
                                        </a>
                                    </h2>
                                    <p>{{ Str::limit($blog->description, 100, '...') }}</p>
                                    {{--
                                    <div class="d-flex justify-content-between text-muted mt-4">
                                        <span><small>22 April 2023</small></span>
                                        <span>
                                            <small>
                                                Read time:
                                                <span class="text-dark fw-bold">12min</span>
                                            </small>
                                        </span>
                                    </div>
                                --}}
                                    <div class="d-flex align-items-center my-3">
                                        <a href="{{ route('read_blogs', $blog->id) }}" class="btn text-white"
                                            style="background: #662F88;">
                                            Read More
                                            <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 col-md-6 col-lg-4 mb-10">
                            <div class="d-flex align-items-center justify-content-center py-4">
                                No blogs found
                            </div>
                        </div>
                    @endif

                    <div class="col-12">
                        <!-- nav -->
                        <nav>
                            {{ $blogs->links('vendor.pagination.default') }}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
