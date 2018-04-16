// START Full Load Render
window.onload = function () {
    $('body').show();
}
// END Full Load Render

// START Read Image File
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.preview').attr('src', e.target.result);
            $('.remove-preview').show();
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$('.remove-preview').click(function(e) {
    e.preventDefault();
    $(this).hide();
    $('.preview').attr('src', '');
    $('.biz_photo').val('');
});
// END Read Image File

// START AOS
AOS.init();
// END AOS

// START Attribute for background images
$('.data-img').each(function() {
    var attr = $(this).attr('data-bg');
    if (typeof attr !== typeof undefined && attr !== false) {
        $(this).css('background-image', 'url('+attr+')');
    }
});
// END Attribute for background images

// START Sign up wizard
$('.prevBtn').click(function() {
    $(this).closest('.step-content').removeClass('active').prev().addClass('active');
    $('.step-panel .step-item span.active').removeClass('active').parent('.step-item').prev().find('.step').addClass('active');
});
$('.nextBtn').click(function() {
    if($('.personal-information').parent('.step-content').hasClass('active')) {
        var fields = $('.personal-information').find("input[type='text'],input[type='email']");
        $('.form-group').removeClass('has-error');
        for(var i=0; i<fields.length; i++) {
            if (!fields[i].validity.valid) {
                $(fields[i]).closest(".form-group").addClass("has-error");
            }
        }
        if(!$('.personal-information').find('.form-group').hasClass('has-error')) {
            $(this).closest('.step-content').removeClass('active').next().addClass('active');
            $('.step-panel .step-item span.active').removeClass('active').parent('.step-item').next().find('.step').addClass('active');
        }
    } else if($('.licenses').parent('.step-content').hasClass('active')) {
        $(".form-group").removeClass("has-error");
        if($('.license-files').get(0).files.length === 0) {
            $('.license-files').closest(".form-group").addClass("has-error");
        } else {
            $('.licenses').closest('.step-content').removeClass('active').next().addClass('active');
            $('.step-panel .step-item span.active').removeClass('active').parent('.step-item').next().find('.step').addClass('active');
        }
    } else if($('.download-jao').parent('.step-content').hasClass('active')) {
        $('.download-jao').closest('.step-content').removeClass('active').next().addClass('active');
        $('.step-panel .step-item span.active').removeClass('active').parent('.step-item').next().find('.step').addClass('active');
    } else {
        // validate last step via submit ajax button
        alert('ajax submit here...');
    }
});
// END Sign up wizard

// START Sign up submission
$('.form-signup').submit(function(e) {
    e.preventDefault();
    // alert('alert');
    var form = $(this),
        action = form.data('action'),
        trigger = $('.btn-submit');
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            trigger.html('Processing ...').attr('disabled', true);
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.alert);
                trigger.html('Submit').removeAttr('disabled');
                form[0].reset();
                $('.step, .step-content').removeClass('active');
                $('.step1, #step-1').addClass('active');
                $('.alert').removeClass('hide alert-danger').addClass('alert-success');
                $('.alert-message').text(msg.message);
            } else {
                alertify.error(msg.alert);
                trigger.html('Submit').removeAttr('disabled');
                $('.step, .step-content').removeClass('active');
                $('.step1, #step-1').addClass('active');
                $('.alert').removeClass('hide alert-success').addClass('alert-danger');
                $('.alert-message').text(msg.message);
            }
        }
    });
});
// END Sign up submission

// START Sign in submission
$('.form-signin').submit(function(e) {
    e.preventDefault();
    var form = $(this),
        action = form.data('action'),
        trigger = $('.btn-submit');
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            trigger.html('Processing ...').attr('disabled', true);
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success') {
                trigger.html('Sign In').removeAttr('disabled');
                $('.alert').addClass('hide');
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.alert);
                trigger.html('Sign In').removeAttr('disabled');
                $('.alert').removeClass('hide alert-danger').addClass('alert-danger');
                $('.alert-message').text(msg.message);
            }
        }
    });
});
// END Sign in submission

// START Edit account
$('.editmyaccount-form').submit(function(e) {
    e.preventDefault();
    var form = $(this),
        action = form.data('action'),
        trigger = $('.btn-save');
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            trigger.html('Processing ...').attr('disabled', true);
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success') {
                trigger.html('Save Changes').removeAttr('disabled');
                alertify.success(msg.alert);
                $('.alert').removeClass('hide alert-success').addClass('alert-success');
                $('.alert-message').text(msg.message);
            } else {
                alertify.error(msg.alert);
                trigger.html('Save Changes').removeAttr('disabled');
                $('.alert').removeClass('hide alert-danger').addClass('alert-danger');
                $('.alert-message').text(msg.message);
            }
        }
    });
});
// END Edit account

// START Change Password
$('.form-changepassword').submit(function(e) {
    e.preventDefault();
    var form = $(this),
        action = form.data('action'),
        trigger = $('.btn-save');
    $.ajax({
        url: action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            trigger.html('Processing ...').attr('disabled', true);
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success') {
                trigger.html('Save Changes').removeAttr('disabled');
                $('.alert').addClass('hide');
                location.replace(msg.redirect);
            } else {
                alertify.error(msg.alert);
                trigger.html('Save Changes').removeAttr('disabled');
                form[0].reset();
                $('.alert').removeClass('hide alert-danger').addClass('alert-danger');
                $('.alert-message').text(msg.message);
            }
        }
    });
});
// END Change Password

// START User panel Sidebar
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
// END User panel Sidebar