<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" >
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css' />
</head>
<body>
<div class="container">
    @include('FrontEnd.include.header')
    <div class="mainContainer">
            @yield('MainContainer')
    </div>
     @include('FrontEnd.include.footer')
</div>
<script src="{{asset('admin/js/jquery2.0.3.min.js')}}"></script>
@yield('script')
</body>
</html>
