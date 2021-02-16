<html lang = "en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="stylesheet" href="resources/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="resources/assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="resources/assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="resources/assets/css/styles.css">

<style>
body {
  background-color: #B0C4DE
;
}
</style>
</head>

<body>

	@include('layouts.header')
	<div align="center">
	@yield('content')
	</div>
	@include('layouts.footer')
</body>

</html>