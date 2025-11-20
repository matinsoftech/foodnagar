@extends('livewire.website.layouts.app')

@section('content')
<main>
    <div class="mt-4">
       <div class="container">
          <div class="row">
             <div class="col-12">
                <!-- breadcrumb -->
                <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item"><a href="#!">Home</a></li>
                      <li class="breadcrumb-item"><a href="#!">Blog</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Freshcart Blog</li>
                   </ol>
                </nav>
             </div>
          </div>
       </div>
    </div>
    <!-- section -->
    <section class="mt-8">
       <div class="container">
          <div class="row">
             <!-- logo -->
             <div class="col-12">
                <h1 class="fw-bold">{{$blog->module->name}} Blog</h1>
             </div>
          </div>
       </div>
    </section>
    <!-- section -->
    <section class="mt-6 mb-lg-14 mb-8">
       <!-- container -->
       <div class="container">
          <div class="row d-flex align-items-center mb-8">
             <div class="col-12 col-md-12 col-lg-8">
                <a href="#!">
                   <!-- img -->
                   <div class="img-zoom">
                      <img src="{{ $blog->getFirstMediaUrl('images') }}" alt="" class="img-fluid w-100" />
                   </div>
                </a>
             </div>
             <!-- text -->
             <div class="col-12 col-md-12 col-lg-4">
                <div class="ps-lg-8 mt-8 mt-lg-0">
                   <h2 class="mb-3"><a href="#!" class="text-inherit">{{$blog->title}}</a></h2>
                   <p>
                    {{ $blog->description}}
                   </p>
                   <div class="d-flex justify-content-between text-muted">
                      <span><small>{{ $blog->created_at->format('F j, Y') }}</small></span>
                      <span>
                         {{--  <small>
                            Read time:
                            <span class="text-dark fw-bold">6min</span>
                         </small>  --}}
                      </span>
                   </div>
                   <div class=" mt-4">
                     <a href="{{ url('https://www.facebook.com/sharer/sharer.php?u=https://nirmayan.com/blogs/7#!') }}" target="_blank" class="me-4 text-reset text-decoration-none social-list__link">
                         
                         <i class="fab fa-facebook-f " style="color: #db3030;"></i>
                     </a>
                     <a href="{{ url('https://twitter.com/intent/tweet?text=Check+out+this+amazing+product!&url=https://nirmayan.com/blogs/7#!') }}" target="_blank" class="me-4 text-reset text-decoration-none social-list__link">
                         <i class="fab fa-twitter" style="color: #db3030;"></i>
                     </a>
                     {{-- <a href="{{ url('https://www.instagram.com/') }}" class="me-4 text-reset text-decoration-none social-list__link">
                         <i class="fab fa-instagram" style="color: #db3030;"></i>
                     </a> --}}
                     <a href="{{ url('https://www.linkedin.com/shareArticle?mini=true&url=YOUR_PRODUCT_URL&title=Check+out+this+amazing+product!&summary=Here+is+a+great+product+that+you+can+share+with+your+friends+and+family!&source=LinkedIn' ) }}" target="_blank" class="me-4 text-reset text-decoration-none social-list__link">
                        
                         <i class="fab fa-linkedin" style="color: #db3030;"></i>
                     </a>
                 </div>
                </div>
             </div>
          </div>
          <!-- row -->

        <!-- Blog Section start-->

        @include('livewire.website.section.blogs')
        <!-- Blog Section end-->
       </div>
    </section>
</main>
@endsection
