<!DOCTYPE html>
<html lang="en-US" dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


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

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">


    </head>



    <body>

        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 login-section-wrapper">
                        <div class="brand-wrapper">
                            <img src="{{ asset('assets/img/icons/blood-drop.png') }}" alt="logo" class="logo">
                            <span class="beautiuni"> သွေးလှူရှင်အသင်း </span>
                        </div>
                      
                        <div class="login-wrapper my-auto">
                            <h1 class="login-title beautiuni"> မိမိအကောင့်ဖြင့်၀င်မည် </h1>

                            @if (session('message'))

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span class="mmfont"> {{ session('message') }} </span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        
                            <form action="{{ route('login') }}" method="post" class="row">
                                @csrf

                                <div class="form-group col-12">
                                    <label for="email" class="mmfont">အီးမေးလ်</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                    <small class="text-danger mmfont"> {{ $errors->first('email') }} </small>

                                </div>
                              
                                <div class="form-group col-12 mb-4">
                                    <label for="password" class="mmfont">စကားဝှက်</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <small class="text-danger mmfont"> {{ $errors->first('password') }} </small>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="mmfont btn btn-lg btn-danger hover-top btn-glow" type="submit">
                                        ၀င်မည်
                                    </button>
                                </div>
                            </form>
                            
                            <p class="login-wrapper-footer-text mt-5"> 
                                <span class="mmfont text-muted"> စေတနာရှင်လူငယ်အခမဲ့ သွေးလှူအသင်း </span> <br> 
                                <span class="mmfont_bold"> ကန့်ဘလူမြို့ </span> 
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 px-0 d-none d-sm-block">
                        <img src="{{ asset('assets/img/login.jpg') }}" alt="login image" class="login-img">
                    </div>
                </div>
            </div>
        </main>

        {{-- <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100 p-b-160 p-t-50">
                    <form class="login100-form validate-form">
                        <span class="beautiuni login100-form-title p-b-43 ">
                            စေတနာရှင်လူငယ် အခမဲ့ သွေးလှူအသင်း
                        </span>
                        
                        <div class="wrap-input100 rs1 validate-input">
                            <input class="input100" type="text" name="username">
                            <span class="label-input100 mmfont">အီးမေးလ်</span>
                        </div>
                        
                        
                        <div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="pass">
                            <span class="label-input100 mmfont">စကားဝှက်</span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn mmfont_bold">
                                ၀င်မည်
                            </button>
                        </div>
                        
                        <div class="text-center w-full p-t-23 text-white mmfont">
                            ကန့်ဘလူမြို့
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        <script src="{{ asset('vendors/@popperjs/popper.min.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendors/is/is.min.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>


    </body>

</html>