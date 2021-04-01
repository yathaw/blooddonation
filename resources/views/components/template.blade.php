<!DOCTYPE html>
<html lang="en-US" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title> Blood Donation </title>


        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/blood-drop.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/blood-drop.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/blood-drop.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/icons/blood-drop.png') }}">
        <!-- <link rel="manifest" href="assets/img/favicons/manifest.json"> -->
        <meta name="msapplication-TileImage" content="{{ asset('assets/img/icons/blood-drop.png') }}">
        <meta name="theme-color" content="#ffffff">


        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />

        <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />

        <!-- Icofont -->
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/icofont/icofont.min.css') }}">

        <!-- Datatable CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatable/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/datatable/buttons.dataTables.min.css') }}">

        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert/sweetalert2.min.css') }}">

        <!-- Select 2 -->
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2_bootstrap4/dist/select2-bootstrap4.min.css') }}">

    </head>


    <body class="d-flex flex-column">

        @php
            $authRole = Auth::user()->getRoleNames()[0];
            $authuser = Auth::user();
        @endphp

        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        <main class="main page-content" id="top">
            <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" data-navbar-on-scroll="data-navbar-on-scroll">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('assets/img/icons/blood-drop.png') }}" alt="" width="30" />
                        <span class="text-1000 fs-1 ms-2 fw-medium mmfont">  
                        <span class="fw-bold mmfont"> သွေးလှူရှင်အသင်း</span></span>
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
                    </button>
              
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
                            <li class="nav-item mmfont">
                                <a class="nav-link {{ Request::segment(1) === 'home' ? 'active' : '' }}" href="{{ route('home') }}"> ပင်မစာမျက်နှာ </a>
                            </li>

                            <li class="nav-item mmfont">
                                <a class="nav-link {{ Request::segment(1) === 'ongoingdonors' ? 'active' : '' }}" href="{{ route('ongoingdonors') }}"> ယခုလှူနိုင်သူများ </a>
                            </li>

                            <li class="nav-item mmfont">
                                <a class="nav-link {{ Request::segment(1) === 'donors' ? 'active' : '' }}" href="{{ route('donors.index') }}"> အလှူရှင်များ </a>
                            </li>
                            <li class="nav-item mmfont">
                                <a class="nav-link {{ Request::segment(1) === 'donations' ? 'active' : '' }}" href="{{ route('donations.index') }}"> လှူဒါန်းမှုမှတ်တမ်း </a>
                            </li>
                            {{-- <li class="nav-item mmfont">
                                <a class="nav-link" href="#"> {{ $authuser->name }} </a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle mmfont" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    အကောင့်
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <small class="dropdown-header mmfont"> {{ $authuser->name }} </small>
                                    </li>
                                    <li><a class="dropdown-item mmfont" href="#">မိမိအကောင့်</a></li>
                                    <li><a class="dropdown-item mmfont" href="#">စကားဝှက်ကိုပြောင်းရန်</a></li>
                              </ul>
                            </li>
                            
                        </ul>
                        <div class="d-flex py-3 py-lg-0">
                            <a href="javascript:void(0)" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="mmfont btn btn-outline-danger rounded-pill order-0 "> ထွက်ရန်
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                        </div>
                    </div>
                </div>
            </nav>


            {{ $slot }}

        </main>
        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->


        <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="pb-0 sticky-footer">
                <div class="bg-200">
                    <div class="container">
                        <div class="row">
                            <hr class="opacity-25" />
                            <div class="text-400 text-center">
                                <p>This template is made with&nbsp;
                                    <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#F53838" viewBox="0 0 16 16">
                                      <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                                    </svg>&nbsp;by&nbsp;<a class="text-900" href="https://themewagon.com/" target="_blank"> YTMN</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of .container-->

            </section>
            <!-- <section> close ============================-->
            <!-- ============================================-->

        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        <script src="{{ asset('plugins/jquery-3.5.1.min.js') }}"></script>

        <script src="{{ asset('vendors/@popperjs/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendors/is/is.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        <!-- Datatable JS -->
        <script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatable/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatable/buttons.colVis.min.js') }}"></script>
        
        <!-- Sweet Alert -->
        <script src="{{ asset('plugins/sweetalert/sweetalert2.all.min.js') }}"></script>

        <!-- Select 2 -->
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $("[data-bs-toggle=popover]").popover();
                $('[data-bs-toggle="tooltip"]').tooltip()            

                $('#donationsearchDiv').hide();
            });

        </script>
        @yield("script_content")

    </body>

</html>