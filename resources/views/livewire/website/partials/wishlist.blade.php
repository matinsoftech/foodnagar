@extends('livewire.website.layouts.app')

@section('content')
    <main>
        <!-- section-->
        <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="#!">Home</a></li>
                                <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Saved items</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mt-8 mb-14">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-8">
                            <!-- heading -->
                            <h1 class="mb-1">Saved items</h1>
                            <p>There are {{ count($wishlists) }} items.</p>
                        </div>
                        <div>
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table text-nowrap table-with-checkbox">
                                    <thead class="table-light">
                                        <tr>
                                            <th>
                                                <!-- form check -->
                                                <div class="form-check">
                                                    <!-- input -->
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkAll" />
                                                    <!-- label -->
                                                    <label class="form-check-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th></th>
                                            <th>Items</th>
                                            <th>Amount</th>
                                            <th>Module</th>
                                            <th>Actions</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlists as $wishlist)
                                            <tr>
                                                <td class="align-middle">
                                                    <!-- form check -->
                                                    <div class="form-check">
                                                        <!-- input -->
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="chechboxTwo" />
                                                        <!-- label -->
                                                        <label class="form-check-label" for="chechboxTwo"></label>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="#"><img
                                                            src="{{ isset($wishlist->product) ?  $wishlist->product->getFirstMediaUrl('default') : $wishlist->service->getFirstMediaUrl('default') }}"
                                                            class="icon-shape icon-xxl" alt="" /></a>
                                                </td>
                                                <td class="align-middle">
                                                    <div>
                                                        <h5 class="fs-6 mb-0"><a href="#"
                                                                class="text-inherit">{{isset($wishlist->product) ? $wishlist->product->name : $wishlist->service->name }}</a></h5>

                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    {{ currencyFormat(isset($wishlist->product) ? (isset($wishlist->product->discount_price) && $wishlist->product->discount_price > 0  ? $wishlist->product->discount_price : $wishlist->product->price) : $wishlist->service->price) }}
                                                </td>
                                                <td class="align-middle"><span class="badge bg-success">{{isset($wishlist->product) ? 'E-commerce': 'Service' }}</span></td>
                                                <td class="align-middle">
                                                    <div class="btn btn-primary btn-sm ">
                                                        <a href="#!" class=" text-light product_btn "
                                                            data-id={{ isset($wishlist->product) ? $wishlist->product->id  :  $wishlist->service->id }}> Add to list</a>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('remove_wishlist_product', $wishlist->id) }}"
                                                        class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Delete">
                                                        <i class="feather-icon icon-trash-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

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
