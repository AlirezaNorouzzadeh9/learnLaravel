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
	@foreach ($errors->all() as $error)
    <div class="text-red-500">{{ $error }}</div>
@endforeach
	<div class="form-wrapper">
		  @if (session()->has('message'))
      <p>{{ session('message') }}</p>
  @endif
		<h5>بازنشانی رمز عبور</h5>

		<!-- form -->
		<form method="POST" form="{{ route("changePassword") }}">
			@csrf
			<div class="form-group">
				<input name="email" type="text" class="form-control text-left" placeholder="ایمیل" dir="ltr" autofocus>
			</div>
			<button class="btn btn-primary btn-block">ثبت</button>
			<hr>
			<p class="text-muted">یک عمل دیگر انجام دهید.</p>
			<a href="{{ route('register') }}" class="btn btn-sm btn-outline-light mr-1 my-1">هم اکنون ثبت نام کنید!</a>
			یا
			<a href="{{ route('login') }}" class="btn btn-sm btn-outline-light ml-1 my-1">وارد شوید!</a>
		</form>
		<!-- ./ form -->

	</div>

	<!-- Plugin scripts -->
	<script src="{{asset('panel/vendors/bundle.js"')}}"></script>

	<!-- App scripts -->
	<script src="{{asset('panelassets/js/app.js')}}"></script>
</body>

</html>