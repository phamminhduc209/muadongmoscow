var app = app || { payment: "transfer", customer_info: {}, cc: "", tid: "" };
let scrollTop,
  scrollLeft = 0;

app.init = function () {
  app.tab();
  app.anchorLink();
  app.sticky();
  app.arr();
};

app.tab = function () {
  $(document).on("click", ".tab a", function (e) {
    e.preventDefault();
    let target = $(this).attr("href").split("#")[1];

    $(this).parent().addClass("active").siblings().removeClass("active");
    $('[data-id="' + target + '"]')
      .fadeIn(0)
      .siblings()
      .fadeOut(0);
    history.pushState({}, "", "#" + target);
  });

  if (location.hash && $(".tab li a[href='" + location.hash + "']").length) {
    $(".tab li a[href='" + location.hash + "']").trigger("click");

    $(".pagination a.page-numbers").each(function (i, a) {
      $(a).attr(
        "href",
        $(a).attr("href") + "#" + $(a).parents(".tab-box").attr("data-id")
      );
    });
  } else {
    $(".tab li:first-child a").trigger("click");
    history.replaceState(null, null, " ");
  }
};

app.anchorLink = function () {
  $(".anchor-link").click(function () {
    if (
      location.pathname.replace(/^\//, "") ==
        this.pathname.replace(/^\//, "") &&
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
      if (target.length) {
        $("html,body").animate(
          {
            scrollTop: target.offset().top,
          },
          1000
        );
        return false;
      }
    }
  });
};

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
  $(".js-arr-head").on("click", function () {
    $(this).toggleClass("is-open");
    $(this).next(".js-arr-body").stop().slideToggle();
  });
  
  $('.lst-dt__head').on('click', function () {
    $(this).toggleClass('is-open');
		$(this).next('.lst-dt__content').stop().slideToggle();
    app.sticky();
	});
};

app.sticky = function () {
  if ($("[data-header-nav-area]").length) {
    function make_sticky() {
      $("[data-header-nav-area]").stick_in_parent({
        parent: "[data-header-area]",
        offset_top: 20,
      });
    }

    if ($(window).width() > 767) {
      make_sticky();
    }

    $(window).on("resize", function () {
      if ($(window).width() > 767) {
        make_sticky();
      } else {
        $("[data-header-nav-area]").trigger("sticky_kit:detach");
      }
    });
  }
};
function processTicketData() {
  const ticketData = {
    total_price: 0,
    events: {},
    payment: "transfer",
    payment_info: "",
  };
  let totalPrice = 0;
  const totalPriceEle = $("#total-price");
  $(".qtySelector input").each(function () {
    const inputEle = $(this);
    const ticketMetaDta = $(this).data("meta");
    const inputValue = parseInt(inputEle.val(), 10);
    if (inputValue) {
      totalPrice += parseInt(ticketMetaDta.price) * inputValue;
      if (!ticketData["events"][ticketMetaDta.event_id]) {
        ticketData["events"][ticketMetaDta.event_id] = {
          event_name: ticketMetaDta.event_name || "",
          tickets: [],
        };
      }
      ticketData["events"][ticketMetaDta.event_id]["event_name"] =
        ticketMetaDta.event_name || "";
      ticketMetaDta.quantity = inputValue;

      ticketData["events"][ticketMetaDta.event_id]["tickets"].push(
        ticketMetaDta
      );
    }
  });
  ticketData.total_price = totalPrice;

  ticketData.payment = app.payment;
  if (ticketData.payment === "agency") {
    ticketData.payment_info = $("select[name=agency-info").val();
  } else if (ticketData.payment === "cash") {
    ticketData.payment_info = $("#cash input[name=address").val();
  }
  totalPriceEle.html(totalPrice);
  return ticketData;
}
$(document).ready(function () {
  $(".page-top a").click(function () {
    $("html, body").animate({ scrollTop: 0 });
    return false;
  });

  app.init();

  Fancybox.bind("[data-fancybox]", {
    Thumbs: false,
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() >= 200) {
      $(".c-backtop").addClass("is-visible");
    } else {
      $(".c-backtop").removeClass("is-visible");
    }
  });

  $(".c-backtop").click(function () {
    $("body,html").animate(
      {
        scrollTop: 0,
      },
      "slow"
    );
  });

  var minVal = 0,
    maxVal = 20;
  $(".increaseQty").on("click", function () {
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
    processTicketData();
  });
  $(".decreaseQty").on("click", function () {
    var $parentElm = $(this).parents(".qtySelector");
    $(this).addClass("clicked");
    setTimeout(function () {
      $(".clicked").removeClass("clicked");
    }, 100);
    var value = $parentElm.find(".qtyValue").val();
    if (value > minVal) {
      value--;
    }
    $parentElm.find(".qtyValue").val(value);
    processTicketData();
  });

  $(document).ready(function () {
    $(".child-div").hide();

    $('input[type="radio"][name="payment"]').on("change", function () {
      $(".child-div").hide();

      const selectedValue = $(this).val();
      app.payment = selectedValue;

      $(`#${selectedValue}`).show();
    });
  });

  $(".des-dt__copy").click(function () {
    const copyText = $(this).data("copy");

    navigator.clipboard.writeText(copyText);
    $(this).html("Copied");
    setTimeout(() => {
      $(this).html("Copy");
    }, 2000);
  });

  $(".amount--copy").click(function () {
    const copyText = $(this).data("copy");

    navigator.clipboard.writeText(copyText);
    $(this).html("Copied");

    setTimeout(() => {
      $(this).html("Copy");
    }, 2000);
  });

  $(".qtySelector input").on("input change", function () {
    processTicketData();
  });
  function showPopup(src, callback) {
    Fancybox.show([
      {
        src,
        type: "inline",
      },
    ]);
    Fancybox.getInstance().on("close", (fancybox, slide) => {
      // Additional close handling
      typeof callback === "function" && callback("close");
    });
  }

  function showError(callback) {
    showPopup("#dialog-checkout-error", callback);
  }
  function showSuccessTransfer(callback) {
    showPopup("#dialog-checkout1", callback);
  }
  function showSuccessOther(callback) {
    showPopup("#dialog-checkout2", callback);
  }
  function showSuccessTransferConfirm(callback) {
    showPopup("#dialog-confirm", callback);
  }
  function resetForm() {
    bookTicketEle.html("Đặt vé");
    app.customer_info = {};
    app.payment = "transfer";
    jQuery("#book-form").get(0)?.reset();
    $('input[type="radio"][name="payment"]').change();
    $(".qtySelector input").val(0);
    processTicketData();
  }
  function validateData(ticketValue) {
    const validateErrors = [];
    if (!jQuery(".frm-item input[name=name]").val()) {
      validateErrors.push("The customer name field is required.");
    } else {
      app.customer_info.name = jQuery(".frm-item input[name=name]").val();
    }
    if (!jQuery(".frm-item input[name=email]").val()) {
      validateErrors.push("The customer email field is required.");
    } else {
      app.customer_info.email = jQuery(".frm-item input[name=email]").val();
    }
    if (!jQuery(".frm-item input[name=phone]").val()) {
      validateErrors.push("The customer phone field is required.");
    } else {
      app.customer_info.phone = jQuery(".frm-item input[name=phone]").val();
    }
    if (app.payment === "cash" && !jQuery("#cash input[name=address]").val()) {
      validateErrors.push("The customer address field is required.");
    } else {
      app.customer_info.address = jQuery("#cash input[name=address]").val();
    }

    if (!ticketValue.total_price) {
      validateErrors.push("The ticket classes field is required.");
    }

    const errorContentEle = jQuery("#error-data");
    if (validateErrors.length) {
      let errorContent = "";
      for (const errorLine of validateErrors) {
        errorContent += `
				<li>
                    <p class="font-nunito">${errorLine}</p>
                </li>
			`;
      }
      errorContentEle.html(errorContent);
      showError(function () {
        bookTicketEle.html("Đặt vé");
      });
      return false;
    }
    return true;
  }
  const bookTicketEle = $("#book-ticket");
  if (bookTicketEle) {
    bookTicketEle.click(function () {
      bookTicketEle.html("Đang đặt vé");
      const ticketValue = processTicketData();
      if (validateData(ticketValue)) {
        jQuery.ajax({
          url: window.ajaxurl,
          type: "POST",
          data: {
            action: "book_ticket", // Must match PHP action name
            skj: window.skj, // Nonce for security
            data: { ...ticketValue, customer_info: app.customer_info },
          },
          success: function (response) {
            if (response.success) {
              if (app.payment === "transfer") {
                jQuery("#dialog-checkout1 .d-total-price > span").html(
                  ticketValue.total_price
                );
                jQuery("#dialog-checkout1 .d-code").html(response.data?.code);
                jQuery("#dialog-checkout1 .d-code-copy").data(
                  "copy",
                  response.data?.code
                );
                app.cc = response.data?.ccode;
                app.tid = response.data?.tid;
                showSuccessTransfer(function () {
                  resetForm();
                });
              } else {
                showSuccessOther(function () {
                  resetForm();
                });
              }
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
          },
        });
      }
    });
    $("#confirm-paid-ticket").click(function () {
      jQuery.ajax({
        url: window.ajaxurl,
        type: "POST",
        data: {
          action: "confirm_paid", // Must match PHP action name
          skj: window.skj, // Nonce for security
          data: { tid: app.tid, cc: app.cc },
        },
        success: function (response) {
          if (response.success) {
            if (Fancybox.getInstance()) {
              Fancybox.getInstance().close();
            }
            showSuccessTransferConfirm();
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", error);
        },
      });
    });
  }
});
