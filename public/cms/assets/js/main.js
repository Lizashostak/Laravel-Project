"use strict";
$.noConflict();
// ===== Success Msg =====
jQuery('.success_msg').delay(2000).slideUp(1000);
jQuery(document).ready(function ($) {

// ===== Scroll to Top Button =====
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200); // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200); // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function () {      // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0                       // Scroll to top of body
        }, 500);
    });
//======vGet Category On Change select,build query string and get products by query CMS View
    $('#category').change(function () {
        var cat_url = $(this).val();
        if (cat_url == 'all') {
            location.search = '';
        } else {
            location.search = "?category=" + cat_url;
        }

    });
//====== Get Category Name + Url- For Add/Edit product
    $("[name='categorie_id']").change(function () {
        var categoryName = $(this).find('option:selected').text();
        $("[ name='cat_name']").val(categoryName);
        var cat_url = categoryName.toLowerCase();
        cat_url = cat_url.replace(/ /g, "_");
        $("[ name='cat_url']").val(cat_url);
    });


//====== Get Category Url - Add/Edit Category
    $("[name='cat_name']").focusout(function () {
        var cat_url = $("[name='cat_name']").val().toLowerCase();
        cat_url = cat_url.trim();
        cat_url = cat_url.replace(/ /g, "_");
        $("[ name='cat_url']").val(cat_url);
    });

// ======= Show client message and change msg status =======
    $('.msg').click(function () {
        $(this).next('.msg-main').toggle();
        var status = $(this).next('.msg-main').attr("data-status");
        if (status == 'unread') {
            $(this).next('.msg-main').attr("data-status", 'read');
            $(this).find('.msg-icon>p>i').removeClass("fas fa-envelope").addClass("far fa-envelope-open");

            var msg_id = $(this).find('.msg_id').text();
            $.ajax({
                url: BASE_URL + "/cms/messages/data",
                data: {
                    new_status: 'read',
                    msg_id: msg_id
                },
                success: function (result) {
                    $('#notification').text(result.length);
                }
            });
        }
    });

//======= Delete msg via modal and ajax =======
    $('.trash').click(function (e) {
        e.stopPropagation();
        $('#modalConfirmDelete').modal('show');
        var msg_id = $(this).attr('data-id');

        $('#delete_msg').click(function () {
            $.ajax({
                url: BASE_URL + "/cms/messages/delete",
                data: {
                    msg_id: msg_id
                },
                success: function (result) {
                    location.reload();
                }
            });
        });
    });

// ======= Cms tamplate Code ======

    [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
        new SelectFx(el);
    });
    jQuery('.selectpicker').selectpicker;
    $('#menuToggle').on('click', function (event) {
        $('body').toggleClass('open');
    });
    $('.search-trigger').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').addClass('open');
    });
    $('.search-close').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.search-trigger').parent('.header-left').removeClass('open');
    });
    // $('.user-area> a').on('click', function(event) {
    // 	event.preventDefault();
    // 	event.stopPropagation();
    // 	$('.user-menu').parent().removeClass('open');
    // 	$('.user-menu').parent().toggleClass('open');
    // });

});