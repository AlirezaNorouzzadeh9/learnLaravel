<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>قالب Nextable - قالب مدیریتی نکستیبل</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{asset('panel/assets/media/image/favicon.png')}}">

	<!-- Theme Color -->
	<meta name="theme-color" content="#5867dd">

	<!-- Plugin styles -->
	<link rel="stylesheet" href="{{asset('panel/vendors/bundle.css')}}" type="text/css">

	<!-- App styles -->
	<link rel="stylesheet" href="{{asset('panel/assets/css/app.css')}}" type="text/css">
</head>

<body class="form-membership">


	<div class="form-wrapper">
@foreach ($errors->all() as $error)
    <div class="text-red-500">{{ $error }}</div>
@endforeach


		<h5>ایجاد حساب</h5>

		<!-- form -->
		<form action="{{ route('setNewPassword') }}" method="POST">
			@csrf
			<div class="form-group">
				<input name="token" type="hidden" value="{{ $token }}" >
			</div>
			<div class="form-group">
				<input name="password" type="password" class="form-control text-left" placeholder="رمز عبور" dir="ltr" >
			</div>
			<div class="form-group">
				<input name="password_confirmation" type="password" class="form-control text-left" placeholder="تکرار رمز عبور" dir="ltr" >
			</div>
			<button type="submit" class="btn btn-primary btn-block">تغییر پسورد</button>
			<hr>
			<a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">وارد شوید!</a>
		</form>
		<!-- ./ form -->

	</div>

	<!-- Plugin scripts -->
	<script src="{{asset('panel/vendors/bundle.js"')}}"></script>

	<!-- App scripts -->
	<script src="{{asset('panelassets/js/app.js')}}"></script>
</body>

</html>