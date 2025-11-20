@foreach ($services as $service)
<div class="col-md-4 col-lg-3 mb-md-3 mb-2 ">
        <div class="card p-3 pb-0">
            <a href="{{ route('product_details', $service->id) }}">
            <img src="{{ $service->getFirstMediaUrl('default') }}" class="card-img-top"
                alt="..." style="height: 250px;">
            </a>
            <div class="card-body">
                <div class="d-flex justify-content-between align-item-center m-auto">
                    <span>
                    @foreach ($service->categories as $category)
                        <a href="{{ route('product_details', $service->id) }}"
                            class="text-decoration-none text-muted"><small>
                                {{ $category->name }}
                            </small></a>
                    @endforeach
                    </span>
                    <span class=" rounded-circle  add_favourite" data-id="{{ $service->id }}">
                        <i class="fa-regular fa-heart icon-Bg-color"></i>
                    </span>

                </div>
                <a href="{{ route('product_details', $service->id) }}">
                    <h5 class="card-title" style="font-weight: 700;">{{ $service->name }}</h5>
                    </a>
                <div class=" d-flex justify-content-between m-auto align-middle">
                    <div class="d-flex gap-1">
                        <img src="{{ $service->vendor->getFirstMediaUrl('documents') }}" alt=""
                            class="col-1 rounded-circle1" style="width: 30px; height: 30px;" />
                        <span class="m-auto" style="opacity: 0.5; font-size: 18px">{{$service->vendor->name}}</span>
                    </div>
                    <span>

                    </span>

                </div>
                <div class="card-text" style="font-size: 16px; color: #908b8b;">

                    <span>

                        {!! Str::limit($service->description, 110) !!}
                    </span>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between border-top-0 pb-3 bg-white">
                <span style="font-weight: 600;">
                    Rs. {{ $service->discount_price ? $service->discount_price : $service->price }}
                </span>
                <button class="card-button-Recomm py-1 product_btn" data-id="{{ $service->id }}"
                    style="font-size: 14px; border: 1px solid rgb(173, 169, 169); ">Book
                    Now</button>
            </div>
        </div>
</div>
@endforeach
