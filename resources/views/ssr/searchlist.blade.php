@foreach($products as $product)
<ul>
    <li class="d-flex align-items-center justify-content-between border-bottom pb-3">
        <div class="d-flex align-items-center gap-3">
            <svg style="width: 1.4rem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <p class="mb-0">{{ $product->name }}</p>
        </div>
        @if($product->vendor_type_id == 9)
        <a href="{{ route('products_view',$product->id) }}">
            <svg style="width: 1.4rem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 19.5-15-15m0 0v11.25m0-11.25h11.25" />
            </svg>
        </a>
        @else
        <a href="{{ route('product_details',$product->id) }}">
            <svg style="width: 1.4rem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m19.5 19.5-15-15m0 0v11.25m0-11.25h11.25" />
            </svg>
        </a>
        @endif

    </li>
</ul>
@endforeach