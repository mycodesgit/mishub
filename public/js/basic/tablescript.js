$(function () {
    $("#example1").DataTable({
        "responsive": false,
        "lengthChange": true, 
        "autoWidth": true,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example2").DataTable({
        "responsive": false,
        "lengthChange": true, 
        "autoWidth": true,
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

    $("#daily").DataTable({
        "responsive": false,
        "lengthChange": false, 
        "autoWidth": true,
        "searching": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example3").DataTable({
        "responsive": true,
        "lengthChange": true, 
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

    $("#exampleEvent").DataTable({
        "responsive": false,
        "lengthChange": false, 
        "autoWidth": false,

    }).buttons().container().appendTo('#exampleEvent_wrapper .col-md-4:eq(0)');

    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});



