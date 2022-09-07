<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Webtalks | @yield('title')</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">
		<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('css/all.css')}}">
		<link rel="stylesheet" href="{{url('css/slick-theme.css')}}">
		<link rel="stylesheet" href="{{url('css/slick.css')}}">
		<link rel="stylesheet" href="{{url('css/style.css')}}">

		<script defer src="{{url('js/alpine.js')}}"></script>

		<script>
			const URL = "{!! url('/') !!}"; // For using app url in js files
		</script>
	</head>

	<body>
		<header class="header-top bg-grey justify-content-center">
			<div class="container">
				<nav class="navbar navbar-expand-lg navigation menu-white">
					<a class="navbar-brand text-uppercase" href="{{url('/')}}">
						<b>Web<span class="text-danger">Talks</span></b>
					</a>
		  
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="fas fa-bars"></span>
					</button>
		  
				  	<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="menu navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link text-dark p-3 my-3 @if(url()->current() === url('/')) active @endif" href="{{url('/')}}">Home</a>
						  	</li>
							  <li class="nav-item">
								<a class="nav-link text-dark p-3 my-3 @if(url()->current() === url('posts/all')) active @endif" href="{{url('posts/all')}}">Posts</a>
						  	</li>
							<li class="nav-item">
								<a class="nav-link text-dark p-3 my-3 @if(url()->current() === url('about')) active @endif" href="{{url('about')}}">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark p-3 my-3 @if(url()->current() === url('contact')) active @endif" href="{{url('contact')}}">Contact</a>
							</li>
							@auth
								<li class="nav-item text-center">
									<div class="dropdown text-end my-4">
										<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="{{cloudinary()->getUrl('images/' . auth()->user()->image)}}" alt="mdo" width="32" height="32" class="rounded-circle">
										</a>
										<ul class="dropdown-menu text-small text-center" style="">
											<li><a class="dropdown-item text-center">{{auth()->user()->name}}</a></li>
											<li><a class="dropdown-item text-center" href="{{url('profile')}}"><i class="fas fa-user"></i>&nbsp;&nbsp;profile</a></li>
											<li><hr class="dropdown-divider"></li>
											<li><a class="dropdown-item text-center" href="{{url('logout')}}"><i class="fas fa-power-off"></i>&nbsp;&nbsp;Sign out</a></li>
										</ul>
									</div>
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link text-dark p-3 my-3 @if(url()->current() === url('register')) active @endif" href="{{url('register')}}">Register</a>
								</li>
								<li class="nav-item">
									<a class="nav-link text-dark p-3 my-3 @if(url()->current() === url('login')) active @endif" href="{{url('login')}}">Login</a>
								</li>
							@endauth
							
					  	</ul>
						<div class="text-lg-right search ml-5 py-3">
							<div class="search_toggle">
								<i class="fas fa-magnifying-glass"></i>
							</div>
						</div>
					</div>
			  	</nav>
			</div>
		</header>

		<div class="search-wrap">
			<div class="overlay">
				<form action="{{route('frontend.search')}}" class="search-form" method="GET">
					@csrf
					<div class="container">
						<input type="hidden" name="current_route" value="{{request()->url()}}">
						<div class="d-flex justify-content-center align-items-center">
							<button type="submit" class="btn btn-dark">
								<i class="fas fa-magnifying-glass"></i>
							</button>
							<input type="text" name="search_box" class="form-control" placeholder="Search..."/>
							<button type="submit" class="btn btn-dark search_toggle toggle-wrap d-inline-block">
								<i class="fas fa-close"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		@if (session('message'))
			<div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms>				
				<div class="container">
					<div class="alert alert-danger mb-5 mt-3 rounded-0" role="alert" id="alert-box">
						{{session('message')}}
					</div>
				</div>
			</div>
		@endif

		{{$slot}}

        <section class="footer-2 section-padding gray-bg pb-5">
			<div class="container">
				<div class="footer-btm mt-5 pt-4 border-top">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<div class="copyright text-center ">
								@ copyright all reserved to WebTalks - 2022
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script src="{{url('js/jquery.min.js')}}"></script>
		<script src="{{url('js/jquery.validate.min.js')}}"></script>
		<script src="{{url('js/additional-methods.js')}}"></script>
		<script src="{{url('js/bootstrap.min.js')}}"></script>
		<script src="{{url('js/popper.min.js')}}"></script>
		<script src="{{url('js/slick.min.js')}}"></script>
		<script src="{{url('js/all.js')}}"></script>
		<script src="{{url('js/script.js')}}"></script>
		<script src="{{url('js/front-end.js')}}"></script>
		<script src="{{url('js/shared.js')}}"></script>
	</body>
</html>