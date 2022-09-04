<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>WebTalks | @yield('title')</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">		
		<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">		
		<link rel="stylesheet" href="{{url('css/all.css')}}">
		<link rel="stylesheet" href="{{url('css/slick-theme.css')}}">
		<link rel="stylesheet" href="{{url('css/slick.css')}}">		
		<link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{url('css/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{url('css/magnific-popup.css')}}">		
		<link rel="stylesheet" href="{{url('css/dataTables.bootstrap5.css')}}">
		<link rel="stylesheet" href="{{url('css/style.css')}}">

		<script defer src="{{url('js/alpine.js')}}"></script>
		<script src="{{url('ckeditor/ckeditor.js')}}"></script>
		<script src="{{url('js/sweetalert.min.js')}}"></script>
	</head>
	<body>
		<header class="header-top bg-grey justify-content-center">
			<div class="container">
				<nav class="navbar navigation menu-white">
					<a class="navbar-brand text-uppercase" href="{{url('admin')}}">
						<b>Web<span class="text-danger">Talks</span></b>
					</a>		  
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="fas fa-bars"></span>
					</button>		  
				  	<div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="menu navbar-nav ml-auto">
							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin')) {{'active'}} @endif" href="{{url('admin')}}">Dashboard</a>
						  	</li>

							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin/posts')) {{'active'}} @endif" href="{{url('admin/posts')}}">Posts</a>
							</li>

							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin/categories')) {{'active'}} @endif" href="{{url('admin/categories')}}">Categories</a>
							</li>

							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin/posts/featured')) {{'active'}} @endif" href="{{url('admin/posts/featured')}}">Featured</a>
							</li>

							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin/comments')) {{'active'}} @endif" href="{{url('admin/comments')}}">Comments</a>
							</li>

							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin/users')) {{'active'}} @endif" href="{{url('admin/users')}}">Users</a> 
							</li>

							<li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('admin/messages')) {{'active'}} @endif" href="{{url('admin/messages')}}">Messages</a> 
							</li>

                            <li class="nav-item text-center">
								<a class="nav-link py-2 px-3 my-2 text-dark @if (url()->current() === url('a/')) {{'active'}} @endif" href="{{url('/')}}">Visit Blog</a>
							</li>

							@auth
								<li class="nav-item text-center">
									<div class="dropdown text-end my-2">
										<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
											<img src="{{asset('images/' . auth()->user()->image)}}" alt="mdo" width="32" height="32" class="rounded-circle">
										</a>
										<ul class="dropdown-menu text-small text-center" style="">
											<li class="text-center"><a class="dropdown-item">Admin</a></li>
											<li><hr class="dropdown-divider"></li>
											<li class="text-center"><a class="dropdown-item" href="{{url('admin/logout')}}"><i class="fas fa-power-off"></i> Sign out</a></li>
										</ul>
									</div>
								</li>
							@endauth
					  	</ul>
					</div>
			  	</nav>
			</div>
		</header>
		<div class="container py-5">

		@if (session('message'))
			<div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms>				
				<div class="alert alert-danger mb-5 rounded-0" role="alert" id="alert-box">
					{{session('message')}}
				</div>
			</div>
		@endif

		@if (session('error'))
			<div class="alert alert-danger mb-5 rounded-0" role="alert" id="alert-box">
				{{session('error')}}
			</div>
		@endif
		
        {{$slot}}
        
    </div>        

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
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>
    <script src="{{url('js/owl.carousel.min.js')}}"></script>
    <script src="{{url('js/slick.min.js')}}"></script>
    <script src="{{url('js/magnific-popup.js')}}"></script>
    <script src="{{url('js/instafeed.min.js')}}"></script>
	<script src="{{url('js/jquery.dataTables.js')}}"></script>
	<script src="{{url('js/dataTables.bootstrap5.js')}}"></script>
    <script src="{{url('js/all.js')}}"></script>
    <script src="{{url('js/script.js')}}"></script>
	<script src="{{url('js/back-end.js')}}"></script>
	<script src="{{url('js/shared.js')}}"></script>
</body>
</html>