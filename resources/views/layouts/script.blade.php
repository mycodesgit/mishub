    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
    <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('template/dist/js/dark-mode.js') }}"></script>
    
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/fullcalendar/fullcalendar.js') }}"></script>

    <!-- ChartJS -->
    @if(request()->routeIs('dashboard'))
        <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('js/chart/barChart.js') }}"></script>
    @endif

    <!-- jquery-validation -->
    <script src="{{ asset('template/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/validation/optiontaskValidation.js') }}"></script>
    <script src="{{ asset('js/validation/dailyValidation.js') }}"></script>
    <script src="{{ asset('js/validation/ganttValidation.js') }}"></script>
    <script src="{{ asset('js/validation/genValidation.js') }}"></script>
    <script src="{{ asset('js/validation/userValidation.js') }}"></script>

    <script src="{{ asset('js/basic/accomscript.js') }}"></script>
    <script src="{{ asset('js/basic/tablescript.js') }}"></script>
    <script src="{{ asset('js/basic/optiontaskscript.js') }}"></script>
    <script src="{{ asset('js/basic/userscript.js') }}"></script>
    <script src="{{ asset('js/basic/studentscript.js') }}"></script>
    <script src="{{ asset('js/basic/calenscript.js') }}"></script>

    @if(request()->routeIs('studentRead'))
        <script src="{{ asset('js/ajax/studentsEnSerialize.js') }}"></script>
    @endif

    @if(request()->routeIs('dailyRead'))
        <script src="{{ asset('js/ajax/accomplishmentSerialize.js') }}"></script>
    @endif

    @if(request()->routeIs('workprogRead'))
        <script src="{{ asset('js/ajax/ganttSerialize.js') }}"></script>
    @endif

   <script>
        @php
            $current_route = request()->route()->getName();
        @endphp

        @if ($current_route === 'eventRead')
            var calendarScript = document.createElement('script');
            calendarScript.src = "{{ asset('js/event/calendarscript.js') }}";
            document.head.appendChild(calendarScript);
            
            var eventScript = document.createElement('script');
            eventScript.src = "{{ asset('js/event/eventscript.js') }}";
            document.head.appendChild(eventScript);
        @endif
    </script>
