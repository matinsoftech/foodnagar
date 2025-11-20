<section class="my-lg-14 my-8">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-6 d-flex justify-content-between">
                <h3 class="mb-0">Category Name</h3>

                <a href="#">View All</a>
            </div>
        </div>

        <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
            <!-- Latest Products Start-->
            {{-- Only display 5 items --}}
                @include('livewire.website.modules.ecommerce.section.product-card')
            <!-- Latest Products End-->
        </div>
    </div>
</section>
