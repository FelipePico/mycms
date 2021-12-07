<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title') - {{Config::get('mycms.name')}}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">

	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="{{ url('/static/css/admin.css?v='.time()) }}">

	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/eba44a726c.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>



	<script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>

	<script>
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
</head>
<body>
	<div class="wrapper">
		<div class="col1">@include('admin.sidebar')</div>
		<div class="col2">
			<nav class="navbar navbar-expand-lg shadow">
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="{{ url('/admin') }}" class="nav-link"> 
								<i class="fas fa-home"></i> Dashboard
							</a>
						</li>
					</ul>
				</div>
			</nav>

			<div class="page">
				<div class="container-fluid">	
					<nav aria-label="breadcrumb">	
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ url('/admin') }}">
									<i class="fas fa-home"></i> Dashboard
								</a>
							</li>
							@section('breadcrumb')
							@show
						</ol>
					</nav>
				</div>

				@if(Session::has('message'))
					<div class="container-fluid">
							<div class="alert alert-{{ Session::get('typealert')}} " style="display:block; margin-bottom: 16px;">
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

				@section('content')
				@show

			</div>
		</div>
	</div> 
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
</body>
</html>
