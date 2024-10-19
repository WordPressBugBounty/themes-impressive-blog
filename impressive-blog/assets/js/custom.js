jQuery(function ($) {
	/* -----------------------------------------
	Banner Section
	----------------------------------------- */
	$('.banner-style-4 .banner-slider').slick({
		autoplaySpeed: 3000,
		dots: false,
		arrows: true,
		nextArrow: '<button class="fas fa-angle-right slick-next"></button>',
		prevArrow: '<button class="fas fa-angle-left slick-prev"></button>',
		rtl: $.RtlCheck(),
		responsive: [{
			breakpoint: 600,
			settings: {
				arrows: false,
				dots: true,
			}
		}]
	});

	/* -----------------------------------------
	Post Carousel
	----------------------------------------- */
	$('.post-carousel ').slick({
		autoplaySpeed: 3000,
		dots: false,
		arrows: true,
		adaptiveHeight: true,
		slidesToShow: 3,
		rtl: $.RtlCheck(),
		nextArrow: '<button class="fas fa-angle-right slick-next"></button>',
		prevArrow: '<button class="fas fa-angle-left slick-prev"></button>',
		responsive: [{
			breakpoint: 1025,
			settings: {
				slidesToShow: 3,
			}
		},
		{
			breakpoint: 600,
			settings: {
				slidesToShow: 2,
			}
		},
		{
			breakpoint: 480,
			settings: {
				slidesToShow: 1,
			}
		}
		]
	});

});