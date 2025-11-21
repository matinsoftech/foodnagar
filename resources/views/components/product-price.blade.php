@props(['product'])

@php
    $original = floatval($product->price);
    $final = floatval($product->final_price);

    // vendor discount
    $vendor = $product->vendor ?? null;
    $vendorActive = $vendor && $vendor->discount_active;

    $discountType = null;
    $discountValue = 0;

    // CASE 1 — Product-level discount
    if (!empty($product->discount_price) && $product->discount_price > 0) {
        $discountType = 'product';
        $discountValue = $original - floatval($product->discount_price);

        // CASE 2 — Vendor-level discount
    } elseif ($vendorActive) {
        $discountType = $vendor->discount_type;
        if ($vendor->discount_type === 'percent') {
            $discountValue = ($original * $vendor->discount_value) / 100;
        } else {
            $discountValue = floatval($vendor->discount_value);
        }
    }

    $youSave = max(0, round($discountValue, 2));
@endphp

<div class="flex flex-col">

    {{-- Final & original prices --}}
    <div>
        <span class="font-semibold text-lg">
            {{ currencyFormat($final) }}
        </span>

        @if ($final < $original)
            <span class="text-sm text-gray-500 line-through ml-1">
                {{ currencyFormat($original) }}
            </span>
        @endif
    </div>

    {{-- Discount details --}}
    @if ($discountType)
        <div class="text-xs text-green-700 mt-1">
            <strong>
                @if ($discountType === 'percent')
                    {{ $vendor->discount_value }}% OFF
                @elseif($discountType === 'flat')
                    {{ currencyFormat($vendor->discount_value) }} OFF
                @elseif($discountType === 'product')
                    {{ currencyFormat($youSave) }} OFF
                @endif
            </strong>
        </div>

        {{-- YOU SAVE --}}
        <div class="text-xs text-blue-600 font-semibold">
            You save: {{ currencyFormat($youSave) }}
        </div>
    @endif

</div>
