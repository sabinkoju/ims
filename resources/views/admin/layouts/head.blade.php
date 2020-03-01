<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Green Computing Nepal" />
    <meta name="author" content="GCN" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="{{ asset('adminAssets/fonts/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminAssets/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminAssets/fonts/material-design-icons/material-icon.css') }}" rel="stylesheet" type="text/css" />
    <!--bootstrap -->
    <link href="{{ asset('adminAssets/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="{{ asset('adminAssets/assets/plugins/material/material.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAssets/assets/css/material_style.css') }}">
    <!-- inbox style -->
    <link href="{{ asset('adminAssets/assets/css/pages/inbox.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="{{ asset('adminAssets/assets/css/theme/light/theme_style.css') }}" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/theme/light/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminAssets/assets/css/theme/light/theme-color.css') }}" rel="stylesheet" type="text/css" />

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset('adminAssets/assets/css/sweetalert.css') }}">
    <style>
        span.form-error{
            color: red !important;
        }
        input.error::placeholder{
            color: red !important;
        }
        span.input-group-text{
            background-color: #335D98 !important;
            color: #fff !important;
        }
        #logoSite img,
        #favicon img{
            border: 1px solid grey !important;
            padding: 10px !important;
        }
    </style>
    @yield('css')
    <!-- favicon -->
    <link rel="shortcut icon" href="../assets/img/favicon.ico" />
</head>