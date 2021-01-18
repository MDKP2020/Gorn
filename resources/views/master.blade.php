<html>
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('static/images/favicon.jpeg') }}">
    <link href="{{ asset('static/css/quasar.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">
    <title>MKP Project</title>
    @yield('head')
  </head>
	<body>
		@yield('content')
    <script src=" {{asset('static/js/vue.min.js')}}"></script>
    <script src=" {{asset('static/js/quasar.min.js')}}"></script>
    <script src=" {{asset('static/js/axios.min.js')}}"></script>
    @yield('scripts')
	</body>
</html>