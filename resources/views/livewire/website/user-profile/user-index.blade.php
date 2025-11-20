@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <style>
        .adpost-card {
            padding: 0;
            background: unset;
        }

        .adpost-title {
            border-bottom: unset;
        }

        .adpost-title::before {
            display: none;
        }
    </style>
@endsection
@section('content')
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
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                                aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>
                    @include('livewire.website.user-profile.account-sidebar')
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-0 p-lg-0">

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="adpost-title m-0 mt-4">
                                <h3>My Products</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Unit</th>
                                            <th>Province</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Ad Type</th>
                                            <th>Category</th>
                                            <th>User Info</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($user_product as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->price ?? 'N/A' }}</td>
                                                <td>{{ $product->unit ?? 'N/A' }}</td>
                                                <td>{{ $product->province->province_name ?? 'N/A' }}</td>
                                                <td>{{ $product->district->district_name ?? 'N/A' }}</td>
                                                <td>{{ $product->city->municipality_name ?? 'N/A' }}</td>
                                                <td>{{ $product->ad_type ?? 'N/A' }}</td>
                                                <td>{{ $product->categories->first()->name ?? 'N/A' }}</td>
                                                <td>
                                                    <strong>Name:</strong> {{ $product->userInfo->user_name ?? 'N/A' }}<br>
                                                    <strong>Email:</strong>
                                                    {{ $product->userInfo->user_email ?? 'N/A' }}<br>
                                                    <strong>Phone:</strong>
                                                    {{ $product->userInfo->user_phone ?? 'N/A' }}<br>
                                                    <strong>Address:</strong>
                                                    {{ $product->userInfo->user_address ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    @if ($product->getFirstMediaUrl('images'))
                                                        <img src="{{ $product->getFirstMediaUrl('images') }}"
                                                            alt="Product Image" width="50">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="13" class="text-center">No products available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
