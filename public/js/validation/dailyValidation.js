
$(function () {
    $('#addDailytask').validate({
        rules: {
            task: {
                required: true
            },
            no_accom: {
                required: true
            },
        },
        messages: {
            task: {
                required: "Please Enter Option Task"
            },
            no_accom: {
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
