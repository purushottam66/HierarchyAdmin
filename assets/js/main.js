(function ($) {
    "use strict";

    /*-------------------------------------
    Background image
    -------------------------------------*/
    $("[data-bg-image]").each(function () {
        var img = $(this).data("bg-image");
        $(this).css({
            backgroundImage: "url(" + img + ")"
        });
    });

    /*-------------------------------------
    After Load All Content Add a Class
    -------------------------------------*/
    window.onload = addNewClass();

    function addNewClass() {
        $('.fxt-template-animation').imagesLoaded().done(function (instance) {
            $('.fxt-template-animation').addClass('loaded');
        });
    }

    /*-------------------------------------
    Toggle Class
    -------------------------------------*/
    // $(".toggle-password").on('click', function () {
    //     $(this).toggleClass("fa-eye fa-eye-slash");
    //     var input = $($(this).attr("toggle"));
    //     if (input.attr("type") == "password") {
    //         input.attr("type", "text");
    //     } else {
    //         input.attr("type", "password");
    //     }
    // });

    /*-------------------------------------
    Youtube Video
    -------------------------------------*/
    // if ($.fn.YTPlayer !== undefined && $("#fxtVideo").length) {
    //     $("#fxtVideo").YTPlayer({ useOnMobile: true });
    // }

    /*-------------------------------------
    Vegas Slider
    -------------------------------------*/
    // if ($.fn.vegas !== undefined && $("#vegas-slide").length) {
    //     var target_slider = $("#vegas-slide"),
    //         vegas_options = target_slider.data('vegas-options');
    //     if (typeof vegas_options === "object") {
    //         target_slider.vegas(vegas_options);
    //     }
    // }

    /*-------------------------------------
    OTP Form (Focusing on next input)
    -------------------------------------*/
    $("#otp-form .otp-input").keyup(function (e) {
        if (e.key === 'Backspace' || e.key === 'Delete') {
            $(this).prev('.otp-input').focus();
        } else if (this.value.length == this.maxLength) {
            $(this).next('.otp-input').focus();
        }
    });

    // Allow only numbers
    $(".otp-input").on("input", function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    /*-------------------------------------
    Social Animation
    -------------------------------------*/
    // $('#fxt-login-option >ul >li').hover(function () {
    //     $('#fxt-login-option >ul >li').removeClass('active');
    //     $(this).addClass('active');
    // });

    /*-------------------------------------
    Preloader
    -------------------------------------*/
    // $('#preloader').fadeOut('slow', function () {
    //     $(this).remove();
    // });






})(jQuery);

