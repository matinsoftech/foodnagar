@extends('livewire.website.layouts.app')

@section('content')
<main>
    @if(!empty($search_products) && is_countable($search_products) && count($search_products) > 0)
    <section class="my-lg-14 my-8">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-6">
                    <h3 class="mb-0 text-center">Total Searched Products : <span class="text-danger">({{$total_products}})</span></h3>
                </div>

            </div>

            <div class="row categories_products mt-4">
                @foreach ($search_products as $module => $products)
                <div class="category-section mb-3">
                    <div class="row">
                        <div class="col-8 mb-6">
                            <h3 class="mb-0">Module Name: {{ $module }}</h3>
                        </div>

                    </div>

                    <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
                        @foreach ($products as $product)
                            <div class="col">
                                <div class="card card-product">
                                    <div class="card-body">
                                        <div class="text-center position-relative">
                                            <div class="position-absolute top-0 start-0">
                                                <span class="badge bg-danger">Sale</span>
                                            </div>
                                            <a href="{{ route('product_details', $product->id) }}">
                                                <img src="{{ $product->getFirstMediaUrl('default') }}"
                                                     alt="" class="mb-3 img-fluid" style="height: 174.8px;"/>
                                            </a>

                                            <div class="card-product-action">
                                                <a href="javascript:void(0)" class="btn-action quickViewModal"
                                                   data-id="{{ $product->id }}">
                                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                       title="Quick View"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="btn-action add_favourite"
                                                   data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"
                                                   data-id="{{ $product->id }}"><i class="bi bi-heart"></i></a>
                                                <a href="javascript:void(0)" class="btn-action Compare"
                                                   data-bs-toggle="tooltip" data-bs-html="true" title="Compare"
                                                   data-id="{{ $product->id }}"><i class="bi bi-arrow-left-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-small mb-1">
                                            @foreach ($product->categories as $category)
                                                <a href="{{ route('product_details', $product->id) }}"
                                                   class="text-decoration-none text-muted"><small>{{ $category->name }}</small></a>
                                            @endforeach
                                        </div>
                                        <h2 class="fs-6"><a href="{{ route('product_details', $product->id) }}"
                                                           class="text-inherit text-decoration-none line-clamp-1">{{ $product->name }}</a></h2>
                                        <div>
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <span class="text-muted small">4.5(149)</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                @if($product->discount_price == null || $product->discount_price <= 0)
                                                  <span class=" text-dark">{{ currencyFormat($product->price) }}</span>
                                                @else
                                                    <span class=" text-dark">{{ currencyFormat($product->discount_price) }}</span>
                                                    <span class="text-decoration-line-through text-muted">{{ currencyFormat($product->price) }}</span>
                                                    {{--  <span><small class="fs-6 ms-2 text-danger">{{ $discount_percent }}% Off</small></span>  --}}
                                                @endif

                                            </div>
                                            <div>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm product_btn"
                                                   data-id="{{ $product->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-plus">
                                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                                    </svg>
                                                    Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </section>
 @else
 <section>
    <div class="container">
        <div class="row">
            <div class="col-12 mb-6">
                <h3 class="mb-0 text-center"> No Product Found </h3>
            </div>

        </div>
    </div>
 </section>

    @endif
    </main>
@endsection
