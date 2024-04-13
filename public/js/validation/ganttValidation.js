
$(function () {
    $('#workAdd').validate({
        rules: {
            task: {
                required: true
            },
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            duration: {
                required: true
            },
        },
        messages: {
            task: {
                required: "Please Enter Option Task"
            },
            start_date: {
                required: "Please Select Date"
            },
            end_date: {
                required: "Please Select Date"
            },
            duration: {
                required: "This field is required"
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
