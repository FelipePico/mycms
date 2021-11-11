<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyCsm - @yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ url('static/css/connect.css?v='.time())}}">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script src="https://kit.fontawesome.com/eba44a726c.js" crossorigin="anonymous"></script>


</head>
<body>

	
	@section('content')
	@show
	
</body>
</html>