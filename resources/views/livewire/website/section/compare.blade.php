@extends('livewire.website.layouts.app')
@section('css')
    <style>
        .braed-crumbs {
            padding-bottom: 1rem;
            margin: 1.5rem 0 2rem;
            border-bottom: 1px solid #e2e2e2;
        }

        .braed-crumbs span .home {
            font-size: 14px;
            font-weight: 500;
            line-height: 24px;
            letter-spacing: 0.005em;
            color: #B7B7B7;
        }

        .braed-crumbs span i {
            color: #B7B7B7;
        }

        .braed-crumbs i {
            color: #898989;
        }

        .braed-crumbs .product-text {
            font-size: 14px;
            font-weight: 500;
            line-height: 24px;
            letter-spacing: 0.005em;
        }

        .product-compare-section {
            justify-content: space-around;
        }

        .compare-product_item {
            --fc-card-spacer-y: 1rem;
            --fc-card-spacer-x: 1rem;
            --fc-card-title-spacer-y: 0.5rem;
            --fc-card-title-color: ;
            --fc-card-subtitle-color: ;
            --fc-card-border-width: 1px;
            --fc-card-border-color: var(--fc-border-color-translucent);
            --fc-card-border-radius: 0.5rem;
            --fc-card-box-shadow: ;
            --fc-card-inner-border-radius: calc(0.5rem - 1px);
            --fc-card-cap-padding-y: 0.5rem;
            --fc-card-cap-padding-x: 1rem;
            --fc-card-cap-bg: var(--fc-card-bg);
            --fc-card-cap-color: ;
            --fc-card-height: ;
            --fc-card-color: ;
            --fc-card-bg: #fff;
            --fc-card-img-overlay-padding: 1rem;
            --fc-card-group-margin: 1rem;
            word-wrap: break-word;
            background-clip: border-box;
            background-color: var(--fc-card-bg);
            border: var(--fc-card-border-width) solid var(--fc-card-border-color);
            border-radius: var(--fc-card-border-radius);
            color: var(--fc-body-color);
            display: flex;
            flex-direction: column;
            height: var(--fc-card-height);
            min-width: 0;
            position: relative;
            padding: 1rem
        }

        .compare-product_item img {
            width: 17rem;
            height: 17rem;
        }

        .product-compare-section {
            margin-bottom: 2rem;
        }
    </style>
@endsection

@section('content')
    <!-- Bread Crumb -->
    <div class="braed-crumbs">
        <div class="container mb-5">
            <span>
                <a href="{{ url('/') }}" class="home">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
            </span>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="text-capitalize product-text">Product Compare</span>
        </div>
    </div>
    <!-- Bread Crumb Ends -->

    <section class="compare-section">
        <div class="container">
            <div class="product-compare-section row " id="compare-products-container">

            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function() {

            let comparedProducts = JSON.parse(localStorage.getItem('compareProducts')) || [];

            $.ajax({
                url: '/get-compare-products',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    comparedProducts: comparedProducts
                },
                success: function(response) {
                    $('#compare-products-container').html(response.view);
                },
                error: function(error) {
                    console.log('error');
                }
            });
        })
    </script>
@endsection
