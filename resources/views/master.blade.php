<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - ECOMMERCE</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">
	<meta name="currency" content="{{ Config::get('mycms.currency') }}">

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/eba44a726c.js" crossorigin="anonymous"></script>
	

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="{{ url('/static/js/mdslider.js?v='.time()) }}"></script>
	<script src="{{ url('/static/js/site.js?v='.time()) }}"></script>
</head>
<body>

	<nav class="navbar navbar-expand-lg shadow">
		<div class="container">
		 	<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/images/barner2.png') }}"></a>
    		<button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      		<i class="fas fa-bars"></i>
    		</button>

    		<div class="navbar navbar">
    			<ul class="navbar-nav ml-auto" id="navigationMain">
    				<li class="nav-item">
    					<a href="{{ url('/') }}" class="nav-link"> <i class="fas fa-home"></i> <span>Inicio</span></a>
    				</li>
    				<li class="nav-item">
    					<a href="{{ url('/store') }}" class="nav-link"> <i class="fas fa-store-alt"></i> <span>Tienda</span></a>
    				</li>
    				<li class="nav-item">
    					<a href="{{ url('/') }}" class="nav-link"> <i class="fas fa-id-card-alt"></i> <span>Sobre Nosotros</span> </a>
    				</li>
    				<li class="nav-item">
    					<a href="{{ url('/') }}" class="nav-link"> <i class="far fa-envelope-open"></i> <span>Contacto</span></a>
    				</li>
    				<li class="nav-item">
    					<a href="{{ url('/car') }}" class="nav-link"> <i class="fas fa-shopping-cart"></i> <span class="carnumber"> 0</span></a>
    				</li>
    				@if(Auth::guest())
    				<li class="nav-item link-acc">
    					<a href="{{ url('/login') }}" class="nav-link btn"> <i class="fas fa-fingerprint"></i></i> Ingresar</a>
    					<a href="{{ url('/register') }}" class="nav-link btn"> <i class="far fa-user-circle"></i></i> Crear Cuenta</a>
    				</li>
    				@else
    				<li class="nav-item link-acc link-user dropdown">
    					<a href="{{ url('/login') }}" class="nav-link btn dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
    						@if(is_null(Auth::user()->avatar)) 
    							<img src="{{ url('/static/images/default-avatar.png') }}"> 
    						@else
								<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}">

    						@endif Hola: {{ Auth::user()->name }}
    					</a>
    					<ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">	
    						@if(Auth::user()->role == "1")
	    						<li>
	    							<a class="dropdown-item" href="{{ url('/admin/') }}">
	    								<i class="fas fa-chalkboard-teacher"></i>
	    								</i> Administración
	    							</a>
	    						</li>
	    					<li><hr class="dropdown-divider"></li>
    						@endif
    						<li>
    							<a class="dropdown-item" href="{{ url('/account/favorites') }}">
    								<i class="fas fa-heart"></i> Favoritos
    							</a>
    						</li>
    						<li>
    							<a class="dropdown-item" href="{{ url('/account/edit') }}">
    								<i class="fas fa-address-card"></i> Editar mi perfil
    							</a>
    						</li>
    						<li>
    							<a class="dropdown-item" href="{{ url('/logout') }}">
    								<i class="fas fa-sign-out-alt"></i> Salir
    							</a>
    						</li>
    					</ul>

    				@endif
    			</ul>
    		</div>
		</div>
	</nav>

	@if(Session::has('message'))
		<div class="container-fluid">
			<div class="alert alert-{{ Session::get('typealert')}} mtop16" style="display:block; margin-bottom: 16px;">
				{{ Session::get('message')}}
				@if ($errors->any())
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				@endif
				<script>
					$('.alert').slideDown();
					setTimeout(function(){ $('.alert').slideUp(); }, 10000);
				</script>
			</div>
		</div>
	@endif	

	<div class="wrapper">
		<div class="container">
			@yield('content')
		</div>
	</div>
	
</body>
</html>
