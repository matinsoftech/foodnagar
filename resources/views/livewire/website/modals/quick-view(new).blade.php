<!-- Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-8">
                <div class="position-absolute top-0 end-0 me-3 mt-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row">
                    <div class="col-lg-6" id="modal-images">
                        <!-- img slide -->
                        <div class="product productModal" id="productModal">
                            @foreach ($images as $key => $image)
                                <div class="zoom" onmousemove="zoom(event)">
                                    <!-- img -->
                                    <img src="{{ $image }}" alt="" />
                                </div>
                            @endforeach
                        </div>
                        <!-- product tools -->
                        <div class="product-tools">
                            <div class="thumbnails row g-3" id="productModalThumbnails">
                                @foreach ($images as $key => $image)
                                    <div class="col-3" class="{{ $key == 0 ? 'tns-nav-active' : '' }}">
                                        <div class="thumbnails-img">
                                            <!-- img -->
                                            <img src="{{ $image }}" alt="" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" id="modal-data">
                        <div class="ps-lg-8 mt-6 mt-lg-0">
                            <a href="#!" class="mb-4 d-block">Bakery Biscuits</a>
                            <h2 class="mb-1 h1">{{$product_detail->name}}</h2>
                            <div class="mb-4">
                                <small class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </small>
                                <a href="#" class="ms-2">(30 reviews)</a>
                            </div>
                            <div class="fs-4">
                                <span class="fw-bold text-dark">${{$product_detail->discount_price}}</span>
                                <span class="text-decoration-line-through text-muted">${{$product_detail->price}}</span>
                                <span><small class="fs-6 ms-2 text-danger">{{$discount_percent}}% Off</small></span>
                            </div>
                            <hr class="my-6" />
                            @if($product_detail->options)
                                <div class="mb-4">
                                    @foreach ($product_detail->options as $option)
                                        <button type="button" class="btn btn-outline-secondary">{{$option->name}}</button>
                                    @endforeach
                                </div>
                            @endif
                            <div>
                                <!-- input -->
                                <!-- input -->
                                <div class="input-group input-spinner">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity" />
                                    <input type="number" step="1" max="10" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input" />
                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                        data-field="quantity" />
                                </div>
                            </div>
                            <div class="mt-3 row justify-content-start g-2 align-items-center">
                                <div class="col-lg-4 col-md-5 col-6 d-grid">
                                    <!-- button -->
                                    <!-- btn -->
                                    <button type="button" class="btn btn-primary product_btn" data-id="{{ $product_detail->id }}">
                                        <i class="feather-icon icon-shopping-bag me-2"></i>
                                        Add to cart
                                    </button>
                                </div>
                                <div class="col-md-4 col-5">
                                    <!-- btn -->
                                    <a class="btn btn-light" href="#" data-bs-toggle="tooltip"
                                        data-bs-html="true" aria-label="Compare"><i
                                            class="bi bi-arrow-left-right"></i></a>
                                    <a class="btn btn-light" href="#!" data-bs-toggle="tooltip"
                                        data-bs-html="true" aria-label="Wishlist"><i
                                            class="feather-icon icon-heart"></i></a>
                                </div>
                            </div>
                            <hr class="my-6" />
                            <div>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Product Code:</td>
                                            <td>{{$product_detail->sku}}</td>
                                        </tr>
                                        <tr>
                                            <td>Availability:</td>
                                            <td>{{$product_detail->available_qty > 0 ? 'In Stock' : 'Not In Stock' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>
                                                @foreach ($product_detail->categories as $category)
                                                    <button class="btn btn-success btn-sm">{{$category->name}}</button>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>
                                                <small>
                                                    01 day shipping.
                                                    <span class="text-muted">( Free pickup today)</span>
                                                </small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
