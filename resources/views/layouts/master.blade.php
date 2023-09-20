<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MIS | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-v6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/mislogoNoBG.png') }}">

    <style>
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
            background-color: #337ab7 !important ;
            color: white;
        }
        [class*="sidebar-dark-"] .nav-treeview > .nav-item > .nav-link.active, 
        [class*="sidebar-dark-"] .nav-treeview > .nav-item > .nav-link.active:hover, 
        [class*="sidebar-dark-"] .nav-treeview > .nav-item > .nav-link.active:focus {
            background-color: #337ab7 !important ;
            color: #fff !important ;
        }
        .navbar-primary {
            background-color: #337ab7 !important ;
        }
        .main-header navbar navbar-expand navbar-white navbar-light {
            background-color: #337ab7 !important ;
        }
        .bg-selectEdit{
            background-color: #dcfdeb !important ;
            color: #000 !important;
        }
        /*.nav-item{
            cursor: pointer !important;
        }
        .nav-link:hover{
            background-color: none !important;
        }
        .nav-header{
            color: #6c757d !important;
        }*/
        .sign-out {
            color: #fff !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #fff"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button" style="color: #fff">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('destroy') }}" class="nav-link" style="color: #fff">
                        <i class="fas fa-power-off"></i> Sign Out
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                {{-- <img src="{{ asset('template/img/mislogoNoBG.png') }}" alt="AdminLTE Logo" class="brand-image"> --}}
                <span class="brand-text font-weight-light pl-3">Management Information System</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image" style="margin-top: 2%; margin-left: -4%;">
                        <img src="{{ asset('template/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route('profileRead') }}" class="d-block ml-2"> {{ Auth::user()->fname }} </a>
                        <b style="font-size: 10pt; color: #a7a7a7">
                            <i class="fa fa-circle text-success" style="font-size: 8pt"></i> {{ Auth::user()->role }}  
                        </b>
                    </div>
                </div>

                @include('control.sidebar')
                
            </div>
        </aside>

        @yield('body')
        
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                V1
            </div>
            Maintain and Managed By: <i>Management Information System  Office</i>
        </footer>
        
    </div>
    

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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

    <!-- jquery-validation -->
    <script src="{{ asset('template/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('js/validation/optiontaskValidation.js') }}"></script>
    <script src="{{ asset('js/validation/dailyValidation.js') }}"></script>
    <script src="{{ asset('js/validation/genValidation.js') }}"></script>
    <script src="{{ asset('js/validation/userValidation.js') }}"></script>

    <script src="{{ asset('js/basic/accomscript.js') }}"></script>
    <script src="{{ asset('js/basic/tablescript.js') }}"></script>
    <script src="{{ asset('js/basic/optiontaskscript.js') }}"></script>
    <script src="{{ asset('js/basic/userscript.js') }}"></script>
    <script src="{{ asset('js/basic/studentscript.js') }}"></script>

    <script>
        @if(Session::has('error'))
            toastr.options = {
                "closeButton":true,
                "progressBar":true,
                'positionClass': 'toast-bottom-right'
            }
            toastr.error("{{ session('error') }}")
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    'positionClass': 'toast-bottom-center'
                }
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        @if(Session::has('success'))
            toastr.options = {
                "closeButton":true,
                "progressBar":true,
                'positionClass': 'toast-bottom-right'
            }
            toastr.success("{{ session('success') }}")
        @endif
    </script>


</body>
</html>