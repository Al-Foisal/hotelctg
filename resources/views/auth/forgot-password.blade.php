<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Otithee Hotel & Resort ERP" name="description" />
    <meta content="MD Hafiz Al Foisal" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('favicon.png')}}">

    <!-- App css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body class="account-body accountbg">
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <!-- Log In page -->
    <div class="container">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="row">
                    <div class="col-lg-5 mx-auto">
                        <div class="card">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <a href="{{route('login')}}" class="logo logo-admin">
                                        <img src="{{asset('logo.jpg')}}" height="50" alt="logo" class="auth-logo">
                                    </a>
                                    <h4 class="mt-3 mb-1 fw-semibold text-white font-18">You forgot your password? <br> Here you can easily retrieve a new password</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="LogIn_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form" action="{{route('storeForgotPassword')}}" method="post">
                                            @csrf
                                            <div class="form-group mb-2">
                                                <label class="form-label" for="email">Email</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="{{old('email')}}">
                                                </div>
                                            </div><!--end form-group-->


                                            <div class="form-group mb-0 row">
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Send password reset link <i class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div><!--end col-->
                                            </div> <!--end form-group-->
                                        </form><!--end form-->

                                    </div>
                                </div>
                            </div><!--end card-body-->

                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
    <!-- End Log In page -->




    <!-- jQuery  -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/waves.js')}}"></script>
    <script src="{{asset('js/feather.min.js')}}"></script>
    <script src="{{asset('js/simplebar.min.js')}}"></script>


</body>

</html>