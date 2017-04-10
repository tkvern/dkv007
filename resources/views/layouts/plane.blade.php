<!DOCTYPE html>

<!--[if IE 8]> <html lang="{{ config('app.locale') }}" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="{{ config('app.locale') }}" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ config('app.locale') }}" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '量子云') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    @if (has_flash_message())
        <div class="flash_message">
        <?php $flash_message = get_flash_message(); ?>
            @include('widgets.alert', array('class'=>$flash_message['level'], 'dismissable'=>true, 'message'=> $flash_message['message'], 'icon'=> 'check'))
        </div>
    @endif
    @yield('body')
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script')
</body>
</html>