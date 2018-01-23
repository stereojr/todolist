<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/dist/css/css/materialize.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/dist/css/sweetalert.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/dist/css/app.css') }}">
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/jquery.form.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/materialize.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/jquery.blockUI.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/sweetalert/sweetalert.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('assets/dist/js/app.js') }}"></script>
</head>
<body>
	@yield('konten')
</body>
</html>
