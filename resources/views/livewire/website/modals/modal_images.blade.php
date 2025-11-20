<div class="product productModal owl-carousel owl-theme" id="productModal">
    @foreach ($images as $key => $image)
        <div class="zoom item" onmousemove="zoom(event)"
            style="background-image: url({{ $image }})">
            <!-- img -->
            <img src="{{ $image }}" alt="" class="img-fluid" />
        </div>
    @endforeach
</div>

<!-- product tools -->
<div class="product-tools">
    <div class="thumbnails row g-3" id="productModalThumbnails">
        @foreach ($images as $key => $image)
            <div class="col-3 {{ $key == 0 ? 'tns-nav-active' : '' }}">
                <div class="thumbnails-img">
                    <!-- img -->
                    <img src="{{ $image }}" alt="" class="img-fluid" />
                </div>
            </div>
        @endforeach
    </div>
</div>




    {{-- <div class="col-lg-6 product-modal-container"> 
        <div class="product product-carousel owl-carousel owl-theme">
            @foreach ($images as $key => $image)
                <div class="item zoom" data-hash="{{ $key }}" onmousemove="zoom(event)"
                    style="background-image: url({{ $image }})">
                    <img src="{{ $image }}" alt="" class="img-fluid" />
                </div>
            @endforeach
        </div>
    </div> --}}

    {{-- <div class="product-e-comm owl-carousel owl-theme" id="product_details-e-comm">
        @foreach ($images as $key => $image)
            <div class="item zoom" data-hash="{{ $key }}" style="background-image: url({{ $image }})">
                <img src="{{ $image }}" alt="" class="img-fluid" />
            </div>
        @endforeach
    </div>  --}}

    <!-- product tools -->
     {{-- <div class="product-tools">
        <div class="thumbnails row g-3 product-thumbnails">
            @foreach ($images as $key => $image)
                <div class="col-3">
                    <div class="thumbnails-img">
                        <a href="#{{ $key }}">
                            <img src="{{ $image }}" alt="" class="img-fluid thumbnail-item"
                                data-index="{{ $key }}" /></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>  --}}
{{-- </div> --}}


 