var app = app || {};
let scrollTop, scrollLeft = 0;

app.init = function () {
	app.tab();
	app.anchorLink();
	app.arr();
	app.sticky();
};

app.tab = function () {
	$(document).on("click", ".tab a", function (e) {
		e.preventDefault();
		let target = $(this).attr("href").split('#')[1];

		$(this).parent().addClass("active").siblings().removeClass("active");
		$('[data-id="' + target + '"]').fadeIn(0).siblings().fadeOut(0);
		history.pushState({}, '', '#' + target);
	});

	if (location.hash && $(".tab li a[href='" + location.hash + "']").length) {
		$(".tab li a[href='" + location.hash + "']").trigger("click");

		$('.pagination a.page-numbers').each(function (i, a) {
			$(a).attr('href', $(a).attr('href') + '#' + $(a).parents('.tab-box').attr('data-id'));
		});
	} else {
		$(".tab li:first-child a").trigger("click");
		history.replaceState(null, null, ' ');
	}
}

app.anchorLink = function () {
	$('.anchor-link').click(function () {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 1000);
				return false;
			}
		}
	});
}

app.stopScroll = function () {
	scrollTop = $(window).scrollTop();
	scrollLeft = $(window).scrollLeft();
	$("html")
		.addClass("noscroll")
		.css("top", -scrollTop + "px");
};

app.resumeScroll = function () {
	$("html").removeClass("noscroll");
	$(window).scrollTop(scrollTop);
	$(window).scrollLeft(scrollLeft);
};

app.arr = function () {
	$('.js-arr-head').on('click', function () {
		$(this).toggleClass('is-open');
		$(this).next('.js-arr-body').stop().slideToggle();
	});
}

app.sticky = function () {
	if ($("[data-header-nav-area]").length) {
		function make_sticky() {
			$("[data-header-nav-area]").stick_in_parent({
				parent: "[data-header-area]",
				offset_top: 20
			});
		}

		if ($(window).width() > 767) {
			make_sticky();
		}

		$(window).on('resize', function () {
			if ($(window).width() > 767) {
				make_sticky();
			} else {
				$("[data-header-nav-area]").trigger("sticky_kit:detach");
			}
		});
	}
}

$(document).ready(function () {
	$('.page-top a').click(function () {
		$('html, body').animate({ scrollTop: 0 });
		return false;
	});

	app.init();

	Fancybox.bind('[data-fancybox]', {
		Thumbs: false,
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() >= 200) {
			$('.c-backtop').addClass('is-visible');
		} else {
			$('.c-backtop').removeClass('is-visible');
		}
	});

	$('.c-backtop').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 'slow');
	});

	var minVal = 1, maxVal = 20;
	$(".increaseQty").on('click', function () {
		var $parentElm = $(this).parents(".qtySelector");
		$(this).addClass("clicked");
		setTimeout(function () {
			$(".clicked").removeClass("clicked");
		}, 100);
		var value = $parentElm.find(".qtyValue").val();
		if (value < maxVal) {
			value++;
		}
		$parentElm.find(".qtyValue").val(value);
	});
	$(".decreaseQty").on('click', function () {
		var $parentElm = $(this).parents(".qtySelector");
		$(this).addClass("clicked");
		setTimeout(function () {
			$(".clicked").removeClass("clicked");
		}, 100);
		var value = $parentElm.find(".qtyValue").val();
		if (value > 1) {
			value--;
		}
		$parentElm.find(".qtyValue").val(value);
	});

	$(document).ready(function () {
		$('.child-div').hide();

		$('input[type="radio"][name="payment"]').on('change', function () {
			$('.child-div').hide();
			
			const selectedValue = $(this).val();
			$(`#${selectedValue}`).show();
		});
	});
});