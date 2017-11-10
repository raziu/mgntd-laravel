jQuery(document).ready(function () {
	jQuery(document).on('click','.edd-fastspring-checkout-btn',function () {

		var download = jQuery(this).attr('data-download-id');
		if( download ){
			console.log('addToCartPack');
			dataLayer.push({
				'event': 'addToCartPack',
				'packID': download
			});
		}
	})
	if (jQuery('.pricing-tables .edd_price:not(.edd-fs-price)').length) {
		jQuery(".pricing-tables .edd_price:not(.edd-fs-price)").each(function () {
			var val = jQuery(this).html();
			val = val.replace(".00", "");
			jQuery(this).html('<sup>$</sup>' + val.substring(1, val.length));

		})
	}
	jQuery('#edd_sl_show_renewal_form, #edd-cancel-license-renewal').click(function (e) {
		e.preventDefault();
		$('#edd-license-key-container-wrap,#edd_sl_show_renewal_form,.edd-sl-renewal-actions').toggle();
		$('#edd-license-key').focus();
	});

	jQuery('#edd-license-key').keyup(function (e) {
		var input = $('#edd-license-key');
		var button = $('#edd-add-license-renewal');

		if (input.val() != '') {
			button.prop("disabled", false);
		} else {
			button.prop("disabled", true);
		}
	});

	if (jQuery('#OM-popups-container').length && jQuery.cookie("wplevel") != 1) {

		jQuery("#OM-popups-container").show();
		jQuery(".optimonk-container").show();


		jQuery.cookie("wplevel", 1);

		jQuery('.OM-conversion-action').on("click", function () {

			//analytics.track("ExpLevel", {
			//      value: jQuery(this).text()
			//    }
			//  );
			sendinblue.track("ExpLevel", {
					value: jQuery(this).text()
				}
			);

			if (jQuery(this).text() == "EXPERIENCED") {
				//analytics.track("ExperiencedWPUser");
				sendinblue.track("ExperiencedWPUser");
			}
			else {
				//analytics.track("BeginnerWPUser");
				sendinblue.track("BeginnerWPUser");
			}
			jQuery("#OM-popups-container").hide();
			jQuery(".optimonk-container").hide();
			return false;
		});

	}


	//Siteground + codeable promotion
	if (jQuery('#join-block').is(':visible')) {
		if (jQuery.cookie("hosting") != 1 && jQuery.cookie("codeable") != 1)


			jQuery.cookie("hosting", 1);

		else {

			if (jQuery.cookie("hosting") == 1 && jQuery.cookie("codeable") != 1) {

				jQuery.cookie("codeable", 1);

				jQuery("#join-block-codeable").show();

			}

			jQuery("#join-block").hide();

		}


		jQuery(".item-action .download a").on("click", function () {


			//analytics.track('Theme downloaded', {

			//  name: jQuery(this).parent().parent().parent().children(".item-name h4").text()

			//  });

		})
	}

	if (typeof toastr !== 'undefined') {
		toastr.options = {
			"closeButton": false,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-bottom-left",
			"preventDuplicates": false,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}
		setTimeout(
			function () {
				toastr.info('100+ people downloaded Zerif last week.');
			}, 4000);

	}

	jQuery(function () {

		jQuery('a[href*="#"]:not([href="#"])').click(function () {

			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

				var target = jQuery(this.hash);

				target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');

				if (target.length) {

					jQuery('html,body').animate({

						scrollTop: target.offset().top

					}, 1000);

					return false;

				}

			}

		});

	});


	jQuery(window).scroll(function () {

		if (jQuery(this).scrollTop() != 0) {

			jQuery('#backtotop').fadeIn();

		} else {

			jQuery('#backtotop').fadeOut();

		}

	});


	jQuery('#backtotop').click(function () {

		jQuery('body,html').animate({scrollTop: 0}, 800);

	});


	jQuery('#edd_checkout_form_wrap').addClass('o-table');


	/*  socials tabs */

	if (jQuery(".social-share").is(":visible")) {

		jQuery("ul.tabs").tabs("div.panes > div");
	}


	jQuery(".pricing-table").on("mouseenter", function () {

		jQuery(this).children("header").animate({paddingTop: "+=15px"}, 750);

	}).on("mouseleave", function () {

		jQuery(this).children("header").animate({paddingTop: "-=15px"}, 600);

	});


	// Responsive Nav

	var joinLink = jQuery("a.join-button").attr("href");

	var joinText = jQuery("a.join-button").text();

	jQuery("#main-header").after("<nav id='responsive-menu' class='clearfix'><a href='#' class='expand-menu'>&#9776;</a></nav>");

	jQuery("nav#main-menu > ul").clone().appendTo("nav#responsive-menu");

	jQuery("nav#responsive-menu > ul").append("<li><a href='" + joinLink + "'>" + joinText + "</a></li>");


	jQuery("nav#responsive-menu .expand-menu").parent().children("ul").hide();

	jQuery("nav#responsive-menu .expand-menu").click(function (e) {

		e.preventDefault();

		jQuery(this).parent().children("ul").slideToggle();

	});


	jQuery(".team-members ul li").on("mouseenter", function (e) {

		e.preventDefault();

		jQuery(this).children(".overlay").stop(0, 0).animate({

			"bottom": "0px"

		});

	});


	jQuery(".team-members ul li").on("mouseleave", function (e) {

		e.preventDefault();

		jQuery(this).children(".overlay").stop(0, 0).animate({

			"bottom": "-30px"

		});

	});


	/* theme collections (also in ajaxLoop.js) */

	jQuery("#main-content .themes-list .theme-pic").hover(function (e) {

		e.preventDefault();

		jQuery(this).children(".overlay").fadeIn();

	}, function () {

		jQuery(this).children(".overlay").fadeOut();

	});


	jQuery("a.logged-in").hover(function () {

		jQuery(".account_links").css({

			"height": "110px",

			"overflow": "visible"

		});

	}, function () {

		jQuery(".account_links").css({

			"height": "0",

			"overflow": "hidden"

		});

	});


	jQuery(".account_links").hover(function () {

		jQuery(this).css({

			"height": "110px",

			"overflow": "visible"

		});

	}, function () {

		jQuery(this).css({

			"height": "0",

			"overflow": "hidden"

		});

	});

	jQuery(".redeem-tshirt .omega").each(function (e) {
		jQuery(this).after("<div class='clearfix'></div>");
	});

	var selectedTshirtGallery = jQuery(".redeem-tshirt .gallery ul.g-nav li.active img").prop("src");
	jQuery(".redeem-tshirt .gallery .current").append("<img src='" + selectedTshirtGallery + "'></img>");
	jQuery(".redeem-tshirt .gallery ul.g-nav li").click(function (e) {
		e.preventDefault();
		jQuery(".redeem-tshirt .gallery ul.g-nav li.active").removeClass("active");
		jQuery(this).addClass("active");
		jQuery(".redeem-tshirt .gallery .current img").attr("src", jQuery(this).children("img").prop("src"));

	});

// Scroll to bottom on Buy Now click
	jQuery(".download-actions .buy-now, .zf-header-button-no-video").click(function (e) {
		if (jQuery(this).text() !== "Download Now" && jQuery(".pricing-tables").length > 0) {
			var pt_top = jQuery(".pricing-tables").offset().top;
			e.preventDefault();
			jQuery("html,body").animate({scrollTop: pt_top}, 1000);
		}
	});


	jQuery('#edd-license-key-container-wrap').append('<input type="submit" id="edd-add-license-renewal" disabled="disabled" class="edd-submit button white button" value="Apply License Renewal"><a class="close_renewal" href="#" id="edd-cancel-license-renewal">Cancel</a>');
	jQuery('#edd-discount-code-wrap').append("<a href='#' class='close_renewal'>Close</a>");
	jQuery('.close_renewal').click(function (e) {
		e.preventDefault;
		jQuery(this).parent().hide();
	});

});
