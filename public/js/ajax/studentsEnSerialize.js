toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right"
};
$(document).ready(function() {
    var dataTable = $('#studEnTable').DataTable({
        "ajax": {
            "url": studEnReadRoute,
            "type": "GET",
        },
        info: true,
        responsive: false,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'stud_id'},
            {data: 'fullname'},
            {data: 'voucher_code'},
            {data: 'course'},
            {
            data: 's_id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var editLink = '<a href="#" class="btn btn-primary btn-sm btn-studEn" data-id="' + row.s_id + '" data-studid="' + row.stud_id + '" data-studname="' + row.fullname + '">' +
                            '<i class="fas fa-eye"></i>' +
                            '</a>';
                        return editLink;
                    } else {
                        return data;
                    }
                },
            },
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.id); 
        }
    });
    $(document).on('studEnAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-studEn', function() {
    var id = $(this).data('id');
    var studID = $(this).data('studid');
    var studName = $(this).data('studname');

    $('#editclassen').attr('id', 'editclassen');
    
    $('#editStudEnId').val(id);
    $('#editstudID').val(studID);
    $('#editstudName').val(studName);
    $('#editStudEnModal').modal('show');
});


$('#editStudEnForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: studEnUpdateRoute,
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editStudEnModal').modal('hide');
                $('#passwordInput').val('');
                $(document).trigger('studEnAdded');
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error, message) {
            var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
            toastr.error(errorMessage);
        }
    });
});

$(document).on('click', '.studfees-delete', function(e) {
    var id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: studfeeDeleteRoute.replace(':id', id),
                success: function(response) {
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(document).trigger('studFeeAdded');
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                    }
                }
            });
        }
    })
});

