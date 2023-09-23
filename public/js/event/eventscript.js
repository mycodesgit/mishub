var totalDataItems = EventPaginateRoute;
var dataItemsPerPage = 10; 
var totalPages = Math.ceil(totalDataItems / dataItemsPerPage);
var currentPage = 1;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
});

function generatePaginationLinks() {
    var paginationHtml = '';
    paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="changePage(' + (currentPage - 1) + ')">&laquo;</a></li>';
    for (var i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
            paginationHtml += '<li class="page-item active"><a href="#" class="page-link">' + i + '</a></li>';
        } else {
            paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="changePage(' + i + ')">' + i + '</a></li>';
        }
    }
    paginationHtml += '<li class="page-item"><a href="#" class="page-link" onclick="changePage(' + (currentPage + 1) + ')">&raquo;</a></li>';
    
    $('#custom-pagination').html(paginationHtml);
}
function changePage(page) {
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        generatePaginationLinks();
        displayDataItems();
    }
}
function displayDataItems() {
    var startIndex = (currentPage - 1) * dataItemsPerPage;
    var endIndex = startIndex + dataItemsPerPage;
    $('#data-container .external-event').hide();
    for (var i = startIndex; i < endIndex && i < totalDataItems; i++) {
        $('#data-container .external-event:eq(' + i + ')').show();
    }
}
generatePaginationLinks();
displayDataItems();

// function getRandomBackground() {
//     var backgrounds = ['bg-primary', 'bg-info', 'bg-warning', 'bg-success', 'bg-danger'];
//     var randomIndex = Math.floor(Math.random() * backgrounds.length);
//     return backgrounds[randomIndex];
// }

// $(document).ready(function() {
//     $('.external-event').each(function() {
//         $(this).addClass(getRandomBackground());
//     });
// });