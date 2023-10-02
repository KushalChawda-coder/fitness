<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Welcome Coach Dashboard</h1>
	  <a href="{{ route('logout') }}" onclick="event.preventDefault();
	                   document.getElementById('logout-form').submit();">
	    <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
	    <span class="align-middle">Logout</span>
	  </a>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
	        @csrf
	</form>
</body>
</html>