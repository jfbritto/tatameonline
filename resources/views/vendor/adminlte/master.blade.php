<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 2'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Laracrop -->
    <link rel="stylesheet" href="{{ asset('vendor/laracrop/jCrop/css/Jcrop.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laracrop/jCrop/css/Jcrop.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    <link rel="icon" href="{{asset("img/ico-page.png")}}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    @include('adminlte::plugins', ['type' => 'css'])

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @yield('adminlte_css')

    <!-- Custom styles for this template -->
    <link href="{{asset('/css/common.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

{{-- <script src="{{ asset('vendor/laracrop/jQuery/jquery-2.2.3.min.js') }}"></script> --}}

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/common/progressbar.min.js') }}"></script>
<script src="{{ asset('js/common/jquery.mask.min.js') }}"></script>

<script src="{{ asset('vendor/laracrop/jCrop/js/Jcrop.js') }}"></script>
<script src="{{ asset('vendor/laracrop/laracrop.js') }}"></script>

@include('adminlte::plugins', ['type' => 'js'])

<script src="{{asset('/js/common.js')}}"></script>
<script src="{{asset('/js/common-after.js')}}"></script>
@yield('adminlte_js')

</body>
</html>
