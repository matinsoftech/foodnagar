$(document).ready(function () {
    $(".hero-main-banner").owlCarousel({
        items: 1,           // Display one image at a time
        loop: true,         // Enable infinite scrolling
        autoplay: true,     // Enable automatic sliding
        autoplayTimeout: 3000, // Time interval between slides (in milliseconds)
        nav: false,         // Disable navigation buttons (optional)
        dots: false,         // Enable pagination dots
        center: false,      // Ensure images are not centered, which might cause alignment issues
        margin: 0,          // Remove any space between items
        autoWidth: false,   // Ensure width is managed by Owl Carousel
        responsive: {
            0: { items: 1 },
            768: { items: 1 },
            1200: { items: 1 },
        }
    });
});

$(document).ready(function () {
    $(".testimonials").owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: false,
        dots: true,
        responsive: {
            0: { items: 1 },

        }
    });
});

$(document).ready(function () {
    $('.category-sliders').owlCarousel({
        items: 4,
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: true,
        navText: ['&#10094;', '&#10095;'],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
});

$(document).ready(function () {
    $('#testimonialCarousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        // nav: true,
        // navText: ['&#10094;', '&#10095;'],
        // dots: false
    });
});

$(document).ready(function () {
    $('#blogSlider').owlCarousel({
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: false,
        // navText: ['&#10094;', '&#10095;'],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
});

$(document).ready(function () {
    $('.ecom-category-slider').owlCarousel({
        loop: true,
        margin: 15,
        autoplay: true,
        autoplayTimeout: 3000,
        dots: false,
        nav: true,
        navText: ['&#10094;', '&#10095;'],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 4
            },
            992: {
                items: 6
            }
        }
    });
});


$(document).ready(function () {
    $(".blogs-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 20,
        nav: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
});


$(document).ready(function () {
    $(".team-slider").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
            },
        },
    });
});

$(document).ready(function () {
    $(".Testimonils").owlCarousel({
        autoplay: true,
        autoplayTimeout: 2000,
        dots: false,
        loop: true,
        center: true,
        margin: 10,
        nav: false,  // Enable navigation arrows
        navText: ["<button>&lt;</button>", "<button>&gt;</button>"],  // Custom arrow buttons
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1000: {
                items: 3,
            }
        }
    });
});

$(document).ready(function () {
    $(".listing-categories").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        margin: 20,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 4
            },
            1000: {
                items: 6
            }
        }
    });
});

$(document).ready(function () {
    $(".listing-recomend-slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        margin: 0,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
});

$(document).ready(function () {
    $(".listing-cities-slider").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        margin: 0,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });
});

$(document).ready(function () {
    $(".ad-feature-slider").owlCarousel({
        items: 1,
        loop: true,
        center: true,
        stagePadding: 100,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>'
        ],
        responsive: {
            0: {
                items: 1,
                stagePadding: 50
            },
            768: {
                items: 1,
                stagePadding: 100
            },
            1024: {
                items: 1,
                stagePadding: 150
            }
        }
    });
});

$(document).ready(function () {
    // Initialize the main carousel
    // var mainCarousel = $(".ad-details-slider").owlCarousel({
    //     items: 1,
    //     loop: true,
    //     nav: true,
    //     dots: false,
    //     autoplay: false,
    //     navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"]
    // });

    // Initialize the thumbnail carousel
    $(".ad-thumb-slider").owlCarousel({
        items: 4,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
    });

    // Sync thumbnails with the main carousel
    // $(".ad-thumb-slider").on("click", "div", function () {
    //     var index = $(this).data("index");

    //     // Adjust the index to account for clones in the main carousel
    //     var mainIndex = index + mainCarousel.find('.owl-item.cloned').length / 2;

    //     // Navigate to the correct index in the main carousel
    //     mainCarousel.trigger("to.owl.carousel", [mainIndex, 300]);
    // });

    // Highlight the active thumbnail when the main carousel changes
    // mainCarousel.on("changed.owl.carousel", function (event) {
    //     // Get the current real index (adjust for clones)
    //     var currentIndex = event.item.index - event.relatedTarget._clones.length / 2;
    //     currentIndex = (currentIndex + event.item.count) % event.item.count; // Handle looping

    //     $(".ad-thumb-slider div").removeClass("active");
    //     $('.ad-thumb-slider div[data-index="' + currentIndex + '"]').addClass("active");
    // });

    // Ensure the first thumbnail is active on load
    // $('.ad-thumb-slider div[data-index="0"]').addClass("active");
});

$(document).ready(function () {
    var items = [
        { details: 'Item 1 details', hash: 'slide1' },
        { details: 'Item 2 details', hash: 'slide2' },
        { details: 'Item 3 details', hash: 'slide3' },
        { details: 'Item 4 details', hash: 'slide4' }
    ];

    var owl = $(".ad-details-slider").owlCarousel({
        items: 1,           // One item per view
        loop: true,         // Infinite loop
        nav: true,
        navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"],
        autoplay: true,     // Enable autoplay
        autoplayTimeout: 3000,
        dots: true,         // Pagination dots
        URLhashListener: true,  // Enable hash navigation
        startPosition: 'URLHash', // Start based on hash
    });

    // Show details of the first item on load
    $('#item-details').text(items[0].details);

    // Update details on item change
    owl.on('changed.owl.carousel', function (event) {
        var currentIndex = event.item.index - event.relatedTarget._clones.length / 2;
        currentIndex = currentIndex % items.length;
        currentIndex = currentIndex < 0 ? items.length + currentIndex : currentIndex;
        $('#item-details').text(items[currentIndex].details);
    });
});

$(document).ready(function () {
    $(".ad-details-feature").owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"],
        autoplay: true,
        autoplayTimeout: 3000,
        dots: true,
        URLhashListener: true,
        startPosition: 'URLHash',
    });
});

$(document).ready(function () {
    $("#product_details").owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"],
        autoplay: true,
        autoplayTimeout: 3000000,
        dots: false,
        URLhashListener: true,
        startPosition: 'URLHash',
    });
});




// $(document).ready(function () {
//     // Initialize the main Owl Carousel
//     var productCarousel = $('.product-carousel').owlCarousel({
//         items: 1, // Show one image at a time
//         loop: true, // Enable looping
//         nav: true, // Add navigation arrows
//         dots: false, // Disable dots
//         smartSpeed: 600, // Smooth transition speed
//     });

//     // Handle thumbnail click
//     $('.product-thumbnails .thumbnail-item').on('click', function () {
//         var index = $(this).data('index'); // Get the index of the clicked thumbnail
//         productCarousel.trigger('to.owl.carousel', [index, 300]); // Move carousel to selected image

//         // Highlight the active thumbnail
//         $('.product-thumbnails .col-3').removeClass('tns-nav-active');
//         $(this).closest('.col-3').addClass('tns-nav-active');
//     });
// });



$(document).ready(function () {

    $(".product").owlCarousel({
        items: 1,           
        loop: true,        
        nav: false,
        navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"],
        autoplay: true,    
        autoplayTimeout: 3000,
        dots: false,        
        URLhashListener: true, 
        startPosition: 'URLHash', 
    });

});

// $(document).ready(function () {

//     $("#productThumbnails").owlCarousel({
//         items: 4,
//         loop: true,
//         margin: 10,
//         nav: false,
//         dots: false,
//         autoplay: true,
//     });
// });


$(document).ready(function () {
    $(".product-e-comm").owlCarousel({
        items: 4,
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,

    });
});

$(document).ready(function () {
    $(".flash-sale-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});


//
// Product Details Start
//

const $commentInput = $('#commentInput');
const $commentActions = $('#commentActions');
const $commentBtn = $('#commentBtn');
const $cancelBtn = $('#cancelBtn');

// Show actions when the input is focused
$commentInput.on('focus', function () {
    $commentActions.removeClass('hidden');
});

// Enable/Disable the comment button based on input
$commentInput.on('input', function () {
    const hasText = $(this).val().trim().length > 0;
    if (hasText) {
        $commentBtn.prop('disabled', false).addClass('enabled');
    } else {
        $commentBtn.prop('disabled', true).removeClass('enabled');
    }
});

// Hide actions when cancel is clicked
$cancelBtn.on('click', function () {
    $commentInput.val('');
    $commentActions.addClass('hidden');
    $commentBtn.prop('disabled', true).removeClass('enabled');
});

// Hide actions when clicking outside the comment section
$(document).on('click', function (e) {
    const isCommentSection = $(e.target).closest('.comment-section').length > 0;
    if (!isCommentSection) {
        $commentActions.addClass('hidden');
    }
});

// Toggle Replies Start
$(".comment_reply").on("click", function () {
    $(".replies").toggleClass("hidden");

});
// Toggle Replies End


// Toggle User Reply
$(".reply-toggle").on("click", function () {
    $(".reply").toggleClass("hidden");
});

$(".reply_cancel").on("click", function () {
    console.log(this.className);
    $(".user_reply").val(""); // Clear the textarea
    $(".reply").toggleClass("hidden");
});

// Toggle User Reply End

//
// Product Details End
//


// Rating Review Howver icon Start

$(document).ready(function () {
    let clickedIndex = -1; // To track the clicked star index

    $('.rating i').hover(
        function () {
            // On hover, make current and all previous icons fa-solid
            $(this).prevAll().addBack().removeClass('fa-regular').addClass('fa-solid');
        },
        function () {
            // On hover out, revert to fa-regular only if not clicked
            if (clickedIndex === -1) {
                $('.rating i').removeClass('fa-solid').addClass('fa-regular');
            } else {
                // Reset to reflect clicked state
                $('.rating i')
                    .removeClass('fa-solid')
                    .addClass('fa-regular')
                    .slice(0, clickedIndex + 1)
                    .removeClass('fa-regular')
                    .addClass('fa-solid');
            }
        }
    );

    $('.rating i').click(function () {
        // Set clickedIndex to the clicked star's index
        clickedIndex = $(this).index();
        // Make all up to and including the clicked star fa-solid
        $('.rating i')
            .removeClass('fa-solid')
            .addClass('fa-regular')
            .slice(0, clickedIndex + 1)
            .removeClass('fa-regular')
            .addClass('fa-solid');
    });
});



// shop-list-carousel
$(document).ready(function () {
    $(".shop-list-carousel").show().owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        margin: 20,
        nav: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
});

// shop-list-carousel ends