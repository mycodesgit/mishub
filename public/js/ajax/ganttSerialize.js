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
                    return `<strong style="font-size: 12pt">${row.task}</strong><br><small>${moment(row.start_date).format('MMMM DD, YYYY')} - ${moment(row.end_date).format('MMMM DD, YYYY')}</small>`;
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
                    return `<div class="progress progress-md" style="border-radius: 5px;">
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
                    return `<span class="badge ${badgeClass}" style="font-size: 10pt">${data}</span>`;
                } 
            },
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-workp" data-id="' + row.id + '" data-task="' + row.task + '" data-startdate="' + row.start_date + '" data-enddate="' + row.end_date + '" data-nono="' + row.duration + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
                            '<button type="button" value="' + data + '" class="dropdown-item dailyac-delete">' +
                            '<i class="fas fa-trash"></i> Delete' +
                            '</button>' +
                            '</div>' +
                            '</div>';
                        return dropdown;
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
    
    $('#editWorkpId').val(id);
    $('#editTask').val(task);
    $('#editstartdate').val(startDate);
    $('#editenddate').val(endDate);
    $('#editDuration').val(workdura);
    $('#editWorkpModal').modal('show');
});