@extends('livewire.website.layouts.app')

@section('content')
    <style>
        .product-card:hover {
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }
    </style>
    <main>
        <!-- section -->
        <section>
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <!-- button -->
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>

                    @include('livewire.website.user-profile.account-sidebar')

                    <div class="col-lg-9 col-md-8 col-12 py-5">
                        <h3>Your Submitted Enquiries</h3>

                        @if ($userEnquiries->isEmpty())
                            <p class="text-muted">You haven't submitted any enquiries yet.</p>
                        @else
                            @foreach ($userEnquiries as $index => $enquiry)
                                <div class="product-card card border-0 shadow-sm col-lg-3">
                                    <div class="product-media position-relative">
                                        <!-- Product Image -->
                                        <img src="{{ $enquiry->product->getFirstMediaUrl('default') }}" alt="product"
                                            class="img-fluid rounded-top"
                                            style="height: 200px; width: 100%; object-fit: cover;">

                                        <!-- Badge -->
                                        <div class="position-absolute top-0 start-0">
                                            <span class="badge bg-primary">Recommended</span>
                                        </div>
                                    </div>

                                    <div class="product-content p-3">
                                        <!-- Product Categories -->
                                        <ol class="breadcrumb product-category mb-2 p-0 bg-transparent">
                                            <li><i class="fas fa-tags me-1"></i></li>
                                            <li class="breadcrumb-item">
                                                <a href="#" class="text-decoration-none text-muted">Luxury</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">Duplex House</li>
                                        </ol>

                                        <!-- Product Title -->
                                        <h5 class="product-title mb-2">
                                            <a href="{{ route('products_view', $enquiry->product_id) }}"
                                                class="text-dark text-decoration-none">
                                                {{ $enquiry->product->name ?? 'N/A' }}
                                            </a>
                                        </h5>

                                        <!-- Meta Information -->
                                        <div class="product-meta mb-3 text-muted small">
                                            <div>
                                                <i
                                                    class="fas fa-map-marker-alt me-1"></i>{{ $enquiry->product->address ?? 'N/A' }}
                                            </div>
                                            <div>
                                                <i
                                                    class="fas fa-clock me-1"></i>{{ $enquiry->product->created_at->format('F j, Y') }}
                                            </div>
                                        </div>

                                        <!-- Price and Actions -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="product-price mb-0 text-primary fw-bold">
                                                    ${{ $enquiry->product->price }}
                                                    <span class="text-muted small">/{{ $enquiry->product->unit }}</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
