
$(function () {
    $('#addoptiontask').validate({
        rules: {
            option_name: {
                required: true
            },
        },
        messages: {
            option_name: {
                required: "Please Enter Option Task"
            },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
