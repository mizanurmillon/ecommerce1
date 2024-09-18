<!DOCTYPE html>
<html lang="en">
<!-- molla/index-3.html  22 Nov 2019 09:55:42 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Molla - Bootstrap eCommerce Template</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/frontend') }}/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/frontend') }}/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/frontend') }}/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('public/frontend') }}/assets/images/icons/site.html">
    <link rel="mask-icon" href="{{ asset('public/frontend') }}/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ asset('public/frontend') }}/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/nouislider/nouislider.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/skins/skin-demo-3.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/demos/demo-3.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/style.css">
    {{-- Toastr Css --}}
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/toastr/toastr.min.css">
     @stack('css')
</head>

<body>
    <div class="page-wrapper">

        {{-- @yield('header') --}}
        @include('layouts.front_partial.header');

        <main class="main">
            {{-- main Content --}}
            @yield('content')
        </main>

        {{-- footer --}}
        @include('layouts.front_partial.footer');

    </div>
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
    
    <div class="mobile-menu-overlay"></div>

    @include('layouts.front_partial.mobile');
    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Sign In</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">User Name *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone *</label>
                                            <input type="text" class="form-control" id="phone" name="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">User Address *</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="singin-email-2">Your Email address *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="singin-email-2" name="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="singin-password-2">Password *</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="singin-password-2" name="password">
                                             @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="form-group">
                                            <label for="conf-password">Confirm Password *</label>
                                            <input type="password" class="form-control" id="conf-password" name="password_confirmation">
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>Register</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                                <label class="custom-control-label" for="signin-remember-2">I agree to the </a>privacy policy *</a></label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="register-email-2">Username or Your email address *</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email-2" name="email">
                                             @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="register-password-2">Password *</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="register-password-2" name="password">
                                             @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN </span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy-2" {{ old('remember') ? 'checked' : '' }} name="remember">
                                                <label class="custom-control-label" for="register-policy-2">Remember Me</label>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot Your Password?</a>
                                            @endif
                                        </div>
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <img src="{{ asset('public/frontend') }}/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="{{ asset('public/frontend') }}/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Plugins JS File -->
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/superfish.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/bootstrap-input-spinner.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.plugin.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.countdown.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/toastr/toastr.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/sweetalert2/sweetalert.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/nouislider.min.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/wNumb.js"></script>
    
    <script src="{{ asset('public/frontend') }}/assets/js/jquery.elevateZoom.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('public/frontend') }}/assets/js/demos/demo-3.js"></script>
    <script src="{{ asset('public/frontend') }}/assets/js/main.js"></script>
    <script>
        //wishlist Count----
        function wishlist(){
            $.ajax({
            type:'get',
            url:'{{ route('count.wishlist') }}',
            dataType:'json',
            success:function(data){
                $('#wishlist_count').empty();
                $('#wishlist_count').append(data.wishlist_count);
            }
            });
        }
        $(document).ready(function(event){
            wishlist();
        });
         /*Logout Sweetalert script */ 
          $(document).on("click","#logout",function(e){
            e.preventDefault();
            var link = $(this).attr("href");
                swal({
                    title: 'Are you Want to logout?',
                    text: "",
                    icon: 'warning',
                    buttons: true,
                    dangerMode:true,
                })
                .then((willDelete) => {
                    if(willDelete){
                        window.location.href = link;
                    }else{
                        swal("Not logout!");
                    }
                });
            });
            //wishlist Alert----
            $(document).on("click","#wishlist",function(e){
            e.preventDefault();
            var link = $(this).attr("href");
                swal({
                    title: 'Are you Want to Wishlist All Delete?',
                    text: "",
                    icon: 'warning',
                    buttons: true,
                    dangerMode:true,
                })
                .then((willDelete) => {
                    if(willDelete){
                        window.location.href = link;
                    }else{
                        swal("Not delete wishlist!");
                    }
                });
            });
         /* Toastr script */ 
          @if(Session::has('message'))
          toastr.options ={
            "progressBar" : true,
            "closeButton" : true,
          }
            var type="{{Session::get('alert-type','info')}}"
            switch(type){
            case 'info':
              toastr.info("{{ Session::get('message') }}");
              break;
            case 'success':
              toastr.success("{{ Session::get('message') }}");
              break;
            case 'warning':
              toastr.warning("{{ Session::get('message') }}");
              break;
            case 'error':
              toastr.error("{{ Session::get('message') }}");
              break;
            }
          @endif
    </script>
    @stack('js')
</body>
</html>