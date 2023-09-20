
$(function () {
    $('#generateReport').validate({
        rules: {
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
        },
        messages: {
            start_date: {
                required: "Please Select Date"
            },
            end_date: {
                required: "Please Select Date"
            },

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-5').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
