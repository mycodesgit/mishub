toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right"
};
$(document).ready(function() {
    $('#workAdd').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: workCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $('#modal-work').modal('hide');
                    $(document).trigger('workpAdded');
                    $('input[name="task"]').val('');
                    $('input[name="start_date"]').val('');
                    $('input[name="end_date"]').val('');
                    $('input[name="duration"]').val('');
                } else {
                    toastr.error(response.message);
                    console.log(response);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });
    
    function formatDate(dateString) {
        return moment(dateString).format('MMM DD, YYYY');
    }
    var dataTable = $('#workTable').DataTable({
        "ajax": {
            "url": workReadRoute,
            "type": "GET",
        },
        info: true,
        responsive: false,
        lengthChange: false,
        searching: false,
        paging: true,
        "columns": [
            { 
                data: null,
                render: function(data, type, row, meta) {
                    return `<span>${meta.row + 1}</span>`;
                } 
            },
            { 
                data: function(row) {
                    return `<strong style="font-size: 10pt">${row.task}</strong><br><small>${moment(row.start_date).format('MMMM DD, YYYY')} - ${moment(row.end_date).format('MMMM DD, YYYY')}</small>`;
                } 
            },
            { 
                data: 'duration',
            },
            { 
                data: 'fnames',
            },
            { 
                data: 'percent_completed',
                render: function(data) {
                    return `<div class="progress progress-sm" style="border-radius: 5px;">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="${data}" aria-valuemin="0" aria-valuemax="100" style="width: ${data}%"></div>
                            </div>
                            <small class="text-bold">${data}% Complete</small>`;
                } 
            },
            { 
                data: 'status',
                render: function(data) {
                    var badgeClass = '';
                    if (data === 'Stuck') {
                        badgeClass = 'badge-danger';
                    } else if (data === 'Working on it') {
                        badgeClass = 'badge-warning';
                    } else if (data === 'Complete') {
                        badgeClass = 'badge-success';
                    }
                    return `<span class="badge ${badgeClass}" style="font-size: 8pt">${data}</span>`;
                } 
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    //console.log('userRoleID:', userRoleID);
                    //console.log('row.user_id:', row.user_id);
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">';
                        var rowUserIDs = row.user_id.split(',');
                        
                        if (rowUserIDs.includes(userRoleID)) {
                            //console.log('User ID is included in row.user_id array');
                            dropdown += '<a href="#" class="dropdown-item btn-workp" data-id="' + row.id + '" data-task="' + row.task + '" data-startdate="' + row.start_date + '" data-enddate="' + row.end_date + '" data-nono="' + row.duration + '" data-name="' + row.fnameshow + '" data-stat="' + row.status + '" data-descmod="' + row.descrip + '" data-percent="' + row.percent_completed + '">' + '<i class="fas fa-pen"></i> Edit' +
                                '</a>' +
                                '<button type="button" value="' + data + '" class="dropdown-item workp-delete">' +
                                '<i class="fas fa-trash"></i> Delete' +
                                '</button>';
                        } else {
                            //console.log('User ID is NOT included in row.user_id array');
                            dropdown += '<span class="dropdown-item disabled"><i class="fas fa-pen"></i> Edit</span>' +
                                '<span class="dropdown-item disabled"><i class="fas fa-trash"></i> Delete</span>';
                        }
                        dropdown += '</div>' +
                            '</div>';
                        return dropdown;
                    } else {
                        return data;
                    }
                },
            }
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.id); 
        }
    });
    $(document).on('workpAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-workp', function() {
    var id = $(this).data('id');
    var task = $(this).data('task');
    var startDate = $(this).data('startdate');
    var endDate = $(this).data('enddate');
    var workdura = $(this).data('nono');
    var stat = $(this).data('stat');
    var name = $(this).data('name');
    var mod = $(this).data('descmod');
    var perCent = $(this).data('percent');
    
    $('#editWorkpId').val(id);
    $('#editTask').val(task);
    $('#editstartdate').val(startDate);
    $('#editenddate').val(endDate);
    $('#editDuration').val(workdura);
    $('#editStatus').val(stat);
    $('#editName').val(name);
    $('#editModule').val(mod);
    $('#editPercent').val(perCent);
    $('#editWorkpModal').modal('show');
});

$('#editWorkpForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: workUpdateRoute,
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editWorkpModal').modal('hide');
                $('#updateStatus').val('');
                $(document).trigger('workpAdded');
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

$(document).on('click', '.workp-delete', function(e) {
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
                url: workDeleteRoute.replace(':id', id),
                success: function(response) {
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(document).trigger('workpAdded');
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                    }
                }
            });
        }
    })
});