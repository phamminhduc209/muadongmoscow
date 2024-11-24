var app = app || {};
let scrollTop, scrollLeft = 0;

app.init = function () {
	app.tab();
	app.anchorLink();
};

app.tab = function () {
	$(document).on("click", ".tab a", function (e) {
		e.preventDefault();
		let target = $(this).attr("href").split('#')[1];

		$(this).parent().addClass("active").siblings().removeClass("active");
		$('[data-id="'+target+'"]').fadeIn(0).siblings().fadeOut(0);
		history.pushState({}, '', '#'+target);
	});

	if( location.hash && $(".tab li a[href='"+location.hash+"']").length ) {
		$(".tab li a[href='"+location.hash+"']").trigger("click");

		$('.pagination a.page-numbers').each(function(i,a){
			$(a).attr('href',$(a).attr('href')+'#'+$(a).parents('.tab-box').attr('data-id'));
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

$(document).ready(function() {
	$('.page-top a').click(function() {
		$('html, body').animate({ scrollTop : 0 });
		return false;
	});

	app.init();
});