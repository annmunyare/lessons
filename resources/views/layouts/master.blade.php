<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name = "csrf-token" content="{{csrf_token()}}">
		<!-- Bootstrap CSS -->
        
		<link rel="stylesheet" href="\css\bootstrap\css\bootstrap.min.css"> 
		<title>Lessons</title>
	</head>
	<body onload="getLessons()">
		@include("layouts.nav")
		@include("layouts.jumbotron")
		
        <div class = "container">
             @yield('content')
         </div>
       
	</body>
</html>