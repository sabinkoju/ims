<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="RedstarHospital" />
    <title>Login - Information Management System</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css" />
    <!-- icons -->
    <link href="{{ asset('adminAssets/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('adminAssets/assets/plugins/iconic/css/material-design-iconic-font.min.css') }}">
    <!-- bootstrap -->
    <link href="{{ asset('adminAssets/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('adminAssets/assets/css/pages/extra_pages.css') }}">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('adminAssets/assets/img/favicon.ico') }}" />
</head>

<body>
<div class="limiter">
    <div class="container-login100 page-background">
        <div class="wrap-login100">



            <form method="post" action="{{ route('adminlogin') }}" class="login100-form validate-form">
                @csrf
					<span class="login100-form-logo">
						<img alt="" src="{{ asset('adminAssets/assets/img/logo-2.png') }}">
					</span>
                <span class="login100-form-title p-b-34 p-t-27">
						Log in Here
					</span>

                @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {!! session('flash_message_error') !!}
                    </div>
                @endif
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        {!! session('flash_message_success') !!}
                    </div>
                @endif

                <div class="wrap-input100" data-validate="Enter username">
                    <input class="input100" type="email" name="email" placeholder="E-Mail">
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                </div>
                <div class="text-center p-t-30">
                    <a class="txt1" href="javascript:">
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- start js include path -->
<script src="{{ asset('adminAssets/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('adminAssets/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('adminAssets/assets/js/pages/extra-pages/pages.js') }}"></script>
<!-- end js include path -->
</body>

</html>