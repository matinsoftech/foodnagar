@foreach ($realestates as $realestate)
<div class="col-md-6 mb-md-4 col-lg-4 mb-3">
    <div class="card" style="position: relative;">
        <a href="{{route('products_view',$realestate->id)}}">
        <img src="{{ $realestate->getFirstMediaUrl('default') }}" class="card-img-top"
            alt="..." style="height: 300px">
        </a>
        <div class="card-body">
            <a href="{{route('products_view',$realestate->id)}}">
                <h5 class="card-title" style="font-weight: 600;">{{$realestate->name}}</h5>
                </a>
            <div class="card-text d-flex gap-md-3">
                <span>
                        {!! Str::limit($realestate->description, 110) !!}
                </span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between  align-middle py-4">
            <div class="d-flex gap-1">
                <img src="{{ $realestate->vendor->getFirstMediaUrl('documents') }}" alt=""
                    class="col-1 rounded-circle1" />
                <span
                    style="    opacity: 0.8;
                margin: auto;">{{$realestate->vendor->name}}</span>
            </div>
            <span style="font-weight: 600; font-size: 22px;">
                Rs .{{ $realestate->discount_price ? $realestate->discount_price : $realestate->price }}
            </span>

        </div>
        <diV class="card-body d-flex gap-2" style="position: absolute;">
            <button class="card-button-Recomm1">Featured</button>
            <button class="card-button-Recomm">For sale</button>

        </diV>
    </div>
</div>
@endforeach
