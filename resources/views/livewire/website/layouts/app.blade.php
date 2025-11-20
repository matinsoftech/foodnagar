<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta content="Codescandy" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <title>{{ config('app.name') }}</title>



    <!-- jQuery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Slick CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">



    {{-- <link href="{{ asset('css/assets/libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/assets/libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" /> --}}

    <link href="{{ asset('css/assets/libs/tiny-slider/dist/tiny-slider.css') }}?v={{ time() }}" rel="stylesheet" />



    <!-- Favicon icon-->

    <link rel="shortcut icon" type="image/x-icon" href="{{ appLogo() }}" />



    <!-- Libs CSS -->

    <link href="{{ asset('css/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}?v={{ time() }}" rel="stylesheet" />

    <link href="{{ asset('css/assets/libs/feather-webfont/dist/feather-icons.css') }}?v={{ time() }}" rel="stylesheet" />

    <link href="{{ asset('css/assets/libs/simplebar/dist/simplebar.min.css') }}?v={{ time() }}" rel="stylesheet" />



    <!-- Theme CSS -->

    <link rel="stylesheet" href="{{ asset('css/assets/css/theme.min.css') }}?v={{ time() }}" />



    <link rel="stylesheet" href="{{ asset('css/assets/css/style.css') }}?v={{ time() }}" />



    <!-- Fontawesome CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" rel="stylesheet">


    <style>
        #search-results {
            max-height: 200px;
            /* Optional: Limit height */
            overflow-y: auto;
            /* Optional: Enable scrolling for many suggestions */
            border: 1px solid #ddd;
            background-color: #fff;
            max-width: 550px;
            top: 75%;
        }

        #search-results li {
            cursor: pointer;
            padding: 10px;
        }

        #search-results li:hover {
            background-color: #f8f9fa;
            /* Bootstrap's light gray */
        }


        .fixed-cart {
            width: 3.3rem;
            position: fixed;
            bottom: 5%;
            right: 4%;
            margin: 1rem;
            z-index: 98;
        }

        .fixed-cart svg {
            width: 80%;
            margin: 0 auto;
            display: block;
        }

        .cart-dropdown {
            display: none;
        }

        .dropdown:hover .cart-dropdown {
            display: block;
        }


        @media(max-width: 991px) {
            .fixed-cart {
                bottom: 10%;
            }
        }

        /* Compare Style  */
        /* Compare Style Ends  */
    </style>


    <!-- Owl Carousel CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    @yield('css')


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>



</head>



<body>



    @include('livewire.website.layouts.partials.header')



    @yield('content')

    <!-- Compare -->
    <div class="compare-count" style="display: none;">
        <a href="{{ url('compare') }}">
            Compare <span id="compare-product-count">0</span>
        </a>
    </div>

    <!-- Compare Ends -->




    @include('livewire.website.modals.shop-cart')

    @include('livewire.website.modals.signin')

    @include('livewire.website.modals.otpverification')

    @include('livewire.website.modals.signup')

    @include('livewire.website.modals.quick-view(copy)')

    @include('livewire.website.modals.location')
    @include('livewire.website.partials.variation')



    @include('livewire.website.layouts.partials.footer')



    <script src="{{ asset('css/assets/js/vendors/validation.js') }}"></script>


    <script type="module" src="{{ asset('css/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script type="module" src="{{ asset('css/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>



    <!-- Theme JS -->

    <script type="module" src="{{ asset('css/assets/js/theme.min.js') }}"></script>



    <script type="module" src="{{ asset('css/assets/js/script.js') }}"></script>



    <script src="{{ asset('css/assets/js/vendors/countdown.js') }}"></script>

    <script src="{{ asset('css/assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>

    <script src="{{ asset('css/assets/js/vendors/tns-slider.js') }}"></script>

    <script src="{{ asset('css/assets/js/vendors/zoom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            cart_product();
            wishlistcount();

            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
            // Show modal on button click
            $('.quickViewModal').on('click', function(e) {
                var product_id = $(this).data('id');
                var full_url = window.location.href;
                var path_after_base = full_url.replace(window.location.origin, '');
                var module_name = path_after_base.startsWith('/services') ? 'Home Services' : '';

                $.ajax({
                    url: "{{ route('ecommerce.product_detail') }}",
                    type: 'post',
                    data: {
                        id: product_id,
                        module_name: module_name,
                    },
                    success: function(response) {
                        if (response.html) {
                            $('#cart_modal #modal-images').html(response.images);
                            $('#cart_modal #modal-data').html(response.html);
                            $('#cart_modal').modal('show');
                        } else {
                            alert('Failed to load product details.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product data:', error);
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#loginForm').on('submit', function(e) {

                e.preventDefault();
                let formData = {
                    login: $('#login').val(),
                    password: $('#password').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: '{{ route('web_login') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#userModal').modal('hide');
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Login Successful!',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message ||
                                    'Login failed. Please try again.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            // Clear previous errors
                            $('#loginForm .invalid-feedback').remove();
                            $('#loginForm .is-invalid').removeClass('is-invalid');


                            // Display validation errors below the input fields
                            for (let field in errors) {
                                let input = $(
                                    `#loginForm [name="${field}"], #loginForm #${field}`);
                                input.addClass('is-invalid');

                                // Append error message below the input field
                                input.parent().append(
                                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                                );
                            }


                        } else {
                            let errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                                xhr.responseJSON.message : 'An unexpected error occurred.';

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: errorMessage,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                });
            });

            $('#registerForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Collect form data
                let formData = {
                    name: $('#fullName').val(),
                    email: $('#register_email').val(),
                    phone: $('#phone').val(),
                    password: $('#register_password').val(),
                    referral_code: $('#referralCode').val(),
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token here
                };

                // Send AJAX request
                $.ajax({
                    url: '{{ route('web_register') }}', // Replace with your signup route
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {

                            // Hide the signup modal and show user modal
                            $('#signupModal').modal('hide');
                            $('#otpverificationmodal').modal('show');
                            $('#user_id').val(response.user.id);

                            // Display success toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Signup successful!',
                                showConfirmButton: false,
                                timer: 2000 // Display duration
                            });


                            // window.location.href = response.url;


                        } else {
                            // Display error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message ||
                                    'Signup failed. Please try again.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('#registerForm .invalid-feedback').remove();
                            $('#registerForm .is-invalid').removeClass('is-invalid');
                            // Display validation errors below the input fields
                            for (let field in errors) {
                                let input = $(`#registerForm [name="${field}"]`);
                                input.addClass('is-invalid');

                                // Append error message below the input field
                                input.parent().append(
                                    `<div class="invalid-feedback">${errors[field][0]}</div>`
                                );
                            }
                        } else {
                            // Display unexpected error toast
                            let errorMessage = xhr.responseJSON && xhr.responseJSON.message ?
                                xhr.responseJSON.message : 'An unexpected error occurred.';

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: errorMessage,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                });
            });

            $('#Otp_verification').submit(function(e) {
                e.preventDefault();

                var user_id = $('#user_id').val();
                var otp = $('#otp').val();

                if (!otp) {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Please enter the OTP',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }

                $.ajax({
                    url: '/auth-verify-phone',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id: user_id,
                        otp: otp
                    },
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled',
                            true); // Disable submit button
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout(() => {
                                window.location.href = '{{ url('/') }}';
                            }, 2000);
                        } else {
                            $('#message').text(response.message).addClass('text-danger');
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: xhr.responseJSON ? xhr.responseJSON.message :
                                'An error occurred',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    },
                    complete: function() {
                        $('button[type="submit"]').prop('disabled',
                            false); // Re-enable submit button
                    }
                });
            });

            let debounceTimeout;

            $('#search_website').on('keyup', function(e) {
                // Clear the previous timeout if the user types again
                clearTimeout(debounceTimeout);

                let search = $(this).val();

                $('#search_suggestions').removeClass('hidden');

                // Set the timeout for the AJAX request after 3 seconds (3000ms)
                debounceTimeout = setTimeout(function() {
                    $.ajax({
                        url: '{{ route('searchWebAjax') }}',
                        method: 'POST',
                        data: {
                            search: search,
                        },
                        success: function(response) {
                            if (response.status == true) {
                                $('#search_suggestions').html(response.products);
                            } else {
                                $('#search_suggestions').html('');
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessages = '';
                                for (let field in errors) {
                                    errorMessages += errors[field][0] + '\n';
                                }

                                // Show validation error toast
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: 'Validation Errors',
                                    text: errorMessages,
                                    showConfirmButton: false,
                                    timer: 5000
                                });
                            } else {
                                // Show unexpected error toast
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'An unexpected error occurred.',
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        }
                    });
                }, 2000); // 3 seconds debounce delay
            });

            $(document).on('click', '#search_website', function() {
                $('#search_suggestions').removeClass('hidden');
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search_website, #search_suggestions').length) {
                    $('#search_suggestions').addClass('hidden');
                }
            });

            $(document).on('click', '.product_btn', function(e) {

                e.preventDefault(); // Prevent the default form submission
                var product_id = $(this).data('id');
                var quantity = $('#cart_modal #modal-data .quantity-field').val() ?? 1;

                // Collect form data
                let formData = {
                    product_id: product_id,
                    quantity: quantity,
                    _token: $('meta[name="csrf-token"]').attr('content') // Ensure CSRF is set correctly
                };

                // Send AJAX request
                $.ajax({
                    url: '{{ route('ecommerce.add_product_to_cart') }}',
                    method: 'post',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            cart_product()
                            // Display success toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000 // Display duration
                            });

                            // Redirect if needed

                        } else {
                            // Display error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }

                        $('#cart_modal').modal('hide');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            for (let field in errors) {
                                errorMessages += errors[field][0] + '\n';
                            }

                            // Display validation error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'warning',
                                title: response.message,
                                text: errorMessages,
                                showConfirmButton: false,
                                timer: 5000 // Longer timer for multiple errors
                            });
                        } else {
                            // Display unexpected error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                });
            });

            $(document).on('click', '.add_favourite', function(e) {

                e.preventDefault(); // Prevent the default form submission
                var product_id = $(this).data('id');

                let formData = {
                    product_id: product_id,
                    _token: $('meta[name="csrf-token"]').attr('content') // Ensure CSRF is set correctly
                };

                // Send AJAX request
                $.ajax({
                    url: '{{ route('add_favourite') }}',
                    method: 'post',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            wishlistcount();
                            // Display success toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000 // Display duration
                            });

                            // Redirect if needed

                        } else {
                            // Display error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }

                        $('#cart_modal').modal('hide');
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            for (let field in errors) {
                                errorMessages += errors[field][0] + '\n';
                            }

                            // Display validation error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'warning',
                                title: response.message,
                                text: errorMessages,
                                showConfirmButton: false,
                                timer: 5000 // Longer timer for multiple errors
                            });
                        } else {
                            // Display unexpected error toast
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                });
            });

            function cart_product() {
                $.ajax({
                    url: '{{ route('cart.count') }}', // The route we defined in Laravel
                    method: 'GET',
                    success: function(response) {
                        if (response.count !== undefined) {
                            // Display the count (for example, update an element on the page)
                            $('#cart-count').text(response
                                .count); // Assume you have an element with id "cart-count"

                            let cartDropdown = $('.simplebar-content');
                            cartDropdown.empty(); // Clear existing items

                            // Check if response.products is an array and has items
                            if (Array.isArray(response.products) && response.products.length > 0) {
                                response.products.forEach(function(item) {
                                    console.log(item);
                                    cartDropdown.append(
                                        `<div class="widget-cart-item">
                                            <div class="media">
                                                <a class="d-block me-2 position-relative overflow-hidden"
                                                    href="#">
                                                    <img width="64" class=""
                                                        src="${item.hasproduct.photo}"
                                                        alt="${item.hasproduct.name}">
                                                </a>
                                                <div class="media-body min-height-0 d-flex align-items-center " style="width: 70%;">
                                                    <div class="flex-grow-1">
                                                        <h2 class="widget-product-title mb-0 mr-2">
                                                            <a href="#"
                                                                class="line--limit-1 fs-6 text-capitalize">
                                                                ${item.hasproduct.name}
                                                            </a>
                                                        </h2>
                                                        <div class="widget-product-meta">
                                                            <span class="text-accent me-2 discount_price">
                                                                ${item.hasproduct.price}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="__quantity">
                                                        <div class="cart-del-btn ms-3">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="red" style="width: 15px;"><path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
                                        // `<li>
                                    //     <a class="dropdown-item d-flex align-items-center" href="${item.hasproduct.photo}">
                                    //         <img src="${item.hasproduct.photo}" alt="${item.hasproduct.name}" class="me-2" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                    //         <div>
                                    //             <div>${item.hasproduct.name}</div>
                                    //             <small class="text-muted">Price: $${item.hasproduct.price}</small>
                                    //         </div>
                                    //     </a>
                                    // </li>`
                                    );
                                });
                            } else {
                                cartDropdown.append(
                                    '<li><span class="dropdown-item text-muted">No items in your Cart</span></li>'
                                );
                            }

                            cartDropdown.append(`
                                <div class="widget-cart-item">
                                    <div class="text-center text-capitalize">
                                        <a class="dropdown-item text-center border justify-content-center" href="{{ url('cart') }}" style="font-weight: 600;">
                                            Expand Cart    
                                            <i class="fa-solid fa-chevron-right ms-3"></i>
                                        </a>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('.dropdown-menu[aria-labelledby="cartDropdown"]').html(
                                '<li><span class="dropdown-item text-muted">No items in your Cart</span></li>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching cart count:', error);
                    }
                });
            }


            function displayEmptyCart(container) {
                container.html(`
                    <div class="text-center">
                        <img class="mb-3 mw-100" src="{{ asset('images/website/empty-cart.svg') }}" alt="Cart">
                        <p class="text-capitalize">Your Cart is Empty!</p>
                    </div>
                `);
            }


            $(document).ready(function() {
                $('#cartDropdown').hover(cart_product);

                $('#cartDropdown').on('show.bs.dropdown', function() {
                    cart_product();
                });
            });


            function wishlistcount() {
                $.ajax({
                    url: "{{ route('countWishlist') }}", // The route we defined in Laravel
                    method: 'GET',
                    success: function(response) {
                        if (response.count !== undefined) {

                            $('#wishlist_count').text(response
                                .count); // Assume you have an element with id "cart-count"

                            let wishlistDropdown = $(
                                '.dropdown-menu[aria-labelledby="wishlistDropdown"]');
                            wishlistDropdown.empty(); // Clear existing items

                            // Check if response.products is an array and has items
                            if (Array.isArray(response.products) && response.products.length > 0) {
                                response.products.forEach(function(item) {
                                    console.log(item);
                                    wishlistDropdown.append(
                                        `<li>
                                            <a class="dropdown-item d-flex align-items-center" href="${item.product.photo}">
                                                <img src="${item.product.photo}" alt="${item.product.name}" class="me-2" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                <div>
                                                    <div>${item.product.name}</div>
                                                    <small class="text-muted">Price: $${item.product.price}</small>
                                                </div>
                                            </a>
                                        </li>`
                                    );
                                });
                            } else {
                                wishlistDropdown.append(
                                    '<li><span class="dropdown-item text-muted">No items in your wishlist</span></li>'
                                );
                            }

                            wishlistDropdown.append(`
                                <li>
                                    <a class="dropdown-item text-center" href="{{ route('wishlist') }}">View All</a>
                                </li>
                            `);

                        } else {
                            $('.dropdown-menu[aria-labelledby="wishlistDropdown"]').html(
                                '<li><span class="dropdown-item text-muted">No items in your wishlist</span></li>'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching wishlist count:', error);
                    }
                });
            }
        });



        // Decrease quantity (Event Delegation)
        $('#cart_modal #modal-data').on('click', '.button-minus', function() {
            let input = $(this).siblings('.quantity-field');
            let currentValue = parseInt(input.val());
            if (currentValue > 1) { // Prevent going below 1
                input.val(currentValue - 1);
            }
        });

        // Increase quantity (Event Delegation)
        $('#cart_modal #modal-data').on('click', '.button-plus', function() {
            let input = $(this).siblings('.quantity-field');
            let currentValue = parseInt(input.val());
            let max = parseInt(input.attr('max')) || Infinity; // Default to Infinity if max is not set
            if (currentValue < max) { // Prevent exceeding max value
                input.val(currentValue + 1);
            }
        });

        $(document).ready(function() {
            var path = "{{ route('autocomplete_search') }}";

            $('#search').on('keyup', function() {
                let query = $(this).val();

                if (query.length >= 2) { // Fetch data when input length is 2 or more
                    $.ajax({
                        url: path,
                        method: 'GET',
                        data: {
                            query: query
                        },
                        success: function(data) {

                            let resultsContainer = $('#search-results');
                            resultsContainer.empty(); // Clear previous results

                            if (data.filter_data.length > 0) {
                                data.filter_data.forEach(function(item) {
                                    // Since `pluck` returns an array of strings, use `item` directly
                                    resultsContainer.append(
                                        `<li class="list-group-item">${item}</li>`
                                    );
                                });
                                resultsContainer.show();
                            } else {
                                resultsContainer.hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching autocomplete data:", error);
                        }
                    });
                } else {
                    $('#search-results').hide(); // Hide results when input is less than 2 characters
                }
            });

            // Handle click event on suggestions
            $(document).on('click', '#search-results li', function() {
                $('#search').val($(this).text()); // Set the selected suggestion in the input
                $('#search-results').hide(); // Hide the suggestions list
            });

            // Hide suggestions when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('#search, #search-results').length) {
                    $('#search-results').hide();
                }
            });

            $('#signupModal, #userModal').on('shown.bs.modal', function() {
                // Clear all input fields
                $(this).find('input, select, textarea').val('');

                // Remove validation error classes and messages
                $(this).find('input, select, textarea').removeClass('is-invalid');
                $(this).find('.invalid-feedback').remove();
            });

        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>


    <!-- Owl Carousel JS -->

    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Compare Script -->
    <script>
        // Compare.js
        document.addEventListener('DOMContentLoaded', function() {
            const compareCountElement = document.getElementById('compare-product-count');
            const compareContainer = document.querySelector('.compare-count');
            let compareProducts = new Set();

            // Load compare products from localStorage
            const savedProducts = JSON.parse(localStorage.getItem('compareProducts')) || [];
            compareProducts = new Set(savedProducts);

            // Update initial count and visibility
            updateCompareCount();

            // Add event listeners to all Compare buttons
            document.querySelectorAll('.btn-action.Compare').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');

                    // Toggle the product in the comparison set
                    if (compareProducts.has(productId)) {
                        // Remove product from the comparison set
                        compareProducts.delete(productId);
                    } else {
                        // Add product to the comparison set
                        compareProducts.add(productId);
                    }

                    // Save the updated set to localStorage
                    saveCompareProducts();

                    // Update the count and visibility
                    updateCompareCount();
                });
            });

            /**
             * Updates the displayed compare count and the visibility of the compare container.
             */
            function updateCompareCount() {
                const count = compareProducts.size;

                // Update the count
                compareCountElement.textContent = count;

                // Show or hide the compare container based on the count
                if (count > 0) {
                    compareContainer.style.display = 'block';
                } else {
                    compareContainer.style.display = 'none';
                }
            }

            /**
             * Saves the current compare products to localStorage.
             */
            function saveCompareProducts() {
                localStorage.setItem('compareProducts', JSON.stringify(Array.from(compareProducts)));
            }
        });
    </script>
    <!-- Compare Script Ends -->

    <script>
        function redirectToCart(event) {
            if (!event.target.closest('.dropdown-menu')) {
                // Prevent dropdown toggle and redirect to the cart page
                event.preventDefault();
                window.location.href = "{{ url('cart') }}";
            }
        }

        function redirectToLogin(event) {
            if (!event.target.closest('.dropdown-menu')) {
                // Prevent dropdown toggle and redirect to the cart page
                event.preventDefault();
                window.location.href = "{{ url('login') }}";
            }
        }


        // Product variation modal add to cart
        $(document).ready(function() {
            $(document).on('click', '.add_cart', function() {
                const $button = $(this);
                const counterHtml = `
                <div class="counter">
                    <button class="decrease">-</button>
                    <span class="count">1</span>
                    <button class="increase">+</button>
                </div>`;
                $button.replaceWith(counterHtml);
            });

            $(document).on('click', '.counter .increase', function() {
                const $count = $(this).siblings('.count');
                const currentCount = parseInt($count.text(), 10);
                $count.text(currentCount + 1);
            });

            $(document).on('click', '.counter .decrease', function() {
                const $count = $(this).siblings('.count');
                const currentCount = parseInt($count.text(), 10);

                if (currentCount > 1) {
                    $count.text(currentCount - 1);
                } else {
                    const $counter = $(this).closest('.counter');
                    $counter.replaceWith(
                        `<button class="add-button add_cart" title="Add to cart" tabindex="0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add
                        </button>`
                    );
                }
            });
        });
        // Product variation modal add to cart ends
    </script>

    @yield('js')




</body>



</html>
