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


// ===== Success Msg =====
$('.success_msg').delay(2000).slideUp(1000);



// ===== Add Product to cart =====
//sending ajax request with product id to url:BASE_URL(public)+/shop/addtocart
$(".add_to_cart").click(function () {
    var product_id = $(this).data('id');
    $.ajax({
        url: BASE_URL + "/cart/addtocart",
        data: {
            product_id: product_id,
        },
        success: function (result) {
            location.reload();
        }
    });
});


//===== Show Change User Password
$(".change_password").click(function () {
    $('.change_password_field').toggle();
    $('.save_change_password').toggle();
});


//===== Update/Delete items in the cart =====
//sending ajax request with product id and data-bind to url:BASE_URL(public)+/cart/updatecart
$(".update_cart").click(function () {
    var product_id = $(this).data('id');
    var product_op = $(this).data('op');
    $.ajax({
        url: BASE_URL + "/cart/updatecart",
        data: {
            product_id: product_id,
            product_op: product_op,
        },
        success: function (result) {
            location.reload();
        }
    });
});


//======Get Category On Change select,build query string and get products by query 
$('#products_filter').change(function () {
    var products_filter = $(this).val();//by_low
    if (products_filter == 'all') {
        location.search = '';
    } else {
        location.search = "?filter=" + products_filter;
    }

});

//===== Send message via Modal + Ajax ========
$(function () {
    $('#ContactUsModal').on('hidden.bs.modal', function (e) {
        $('form#reused_form').show();
        $('#success_message').hide();
        $('#error_message').hide();
        resetSendButton();
        $('form#reused_form')[0].reset();
    });
    function after_form_submitted(data) {
        if (data.success) {
            $('form#reused_form').hide();
            $('#success_message').show();
            setTimeout(function () {
                $('#ContactUsModal').modal('hide');
            }, 1500);
            $('#error_message').hide();
        } else {
            $('#error_message').append('<ul></ul>');
            jQuery.each(data.errors, function (key, val) {
                $('#error_message ul').append('<li>' + key + ':' + val + '</li>');
            });
            $('#success_message').hide();
            $('#error_message').show();
            //reverse the response on the button
            resetSendButton();
        }//else
    }
    function resetSendButton() {
        $('button[type="button"]', $form).each(function () {
            $btn = $(this);
            label = $btn.prop('orig_label');
            if (label) {
                $btn.prop('type', 'submit');
                $btn.text(label);
                $btn.prop('orig_label', '');
            }
        });
    }
    $('#reused_form').submit(function (e) {
        e.preventDefault();
        $form = $(this);
        //show some response on the button
        $('button[type="submit"]', $form).each(function () {
            $btn = $(this);
            $btn.prop('type', 'button');
            $btn.prop('orig_label', $btn.text());
            $btn.text('Sending ...');
        });
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url: BASE_URL + "/user/contactus",
            data: $form.serialize(),
            success: after_form_submitted,
            error: after_form_submitted,
            dataType: 'json'
        });
    });
});

