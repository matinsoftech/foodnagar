@if (count($blogs) > 0)

    <section class="my-lg-14 my-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-6 d-flex justify-content-between">
                    <div>
                        <h4 style="color: #ffb600; letter-spacing: 4px;">Blogs</h3>
                            <h4
                                style="color:#000;font-weight: 600;
                    font-size: 40px;">
                                News and Articles
                            </h4>
                    </div>

                    <a href="{{ url('blog-list') }}">View All</a>
                </div>
            </div>
            <div class="owl-carousel owl-theme blogs-carousel">
                @foreach ($blogs as $blog)
                    <div class="">
                        <div class="mb-4">
                            <a href="{{ route('read_blogs', $blog->id) }}">
                                <!-- img -->
                                <div class="img-zoom">
                                    <img src="{{ $blog->getFirstMediaUrl('images') }}" alt=""
                                        class="img-fluid w-100" style="height:250px" />
                                </div>
                            </a>
                        </div>
                        <div class="mb-3"><a class="clr_primary" href="{{ route('read_blogs', $blog->id) }}">{{ $blog->module->name }}</a></div>
                        <div>
                            <h2 class="h5"><a href="{{ route('read_blogs', $blog->id) }}"
                                    class="text-inherit text-truncate">{{ $blog->title }}</a></h2>
                            <p>{{ Str::limit($blog->description, 90, '...') }}</p>
                            <div class="d-flex align-items-center my-3">
                                <a href="{{ route('read_blogs', $blog->id) }}" class="btn text-white bg_primary">
                                    Read More
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Repeat each column content as individual items -->
            </div>

        </div>
    </section>
@endif
