@foreach ($ecommerces as $product)
<div class="col-md-4 mb-2">
    <div class="card border-0" style="position: relative;">
        <a href="{{ route('product_details', $product->id) }}">
            <img src="{{ $product->getFirstMediaUrl('default')}}" class="card-img-top"
                alt="..." style="height: 300px;">
            </a>
        <div class="card-body text-center">
            <h5 class="card-title">Materials</h5>
            <div class="row" style="height: auto;">
                <div class=" justify-content-center  align-content-center align-item-center d-flex"
                    style="white-space: nowrap; ">
                    <div class="star-rating mx-0 me-2 pt-1">
                        <i class="fa fa-star" data-index="0"></i>
                        <i class="fa fa-star" data-index="1"></i>
                        <i class="fa fa-star" data-index="2"></i>
                        <i class="fa fa-star" data-index="3"></i>
                        <i class="fa fa-star" data-index="4"></i>
                    </div>
                    <p id="rating-value" class="">0 Reviews</p>
                </div>
            </div>
            <a href="{{ route('product_details', $product->id) }}">
            <h4 class="card-text mb-4"
                style="
            font-weight: 600;">{{$product->name}}</h4>
            </a>
            <h5 style="color: #ff6600; font-weight: 600;">Rs.{{$product->discount_price ?  $product->discount_price : $product->price }}</h5>
        </div>

        <div
            style="position: absolute;clip-path:polygon(100% 15%, 82% 55%, 100% 93%, 10% 100%, 10% 15%); background-color: #ff6600; font-size: 14px; width:55px; text-align: center; top:20px ; left: -5px;">
            <span style="font-size: 12px; color: #fff;">New</span>
        </div>
    </div>
</div>
@endforeach
