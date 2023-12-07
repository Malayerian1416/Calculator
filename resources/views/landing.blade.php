<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SWM Calculator</title>
    <link rel="icon" href="{{asset("favicon.ico")}}">
    @routes()
    @vite(['resources/sass/app.scss','resources/css/app.css'])
</head>
<body class="antialiased welcome-body">
<div id="app" class="main">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="card shadow" style="width: 30rem;">
            <div class="card-header p-3">
                <img src="{{asset("/images/welcome.png")}}" class="card-img-top" alt="swm calculator">
                <a class="pt-2" href="https://www.freepik.com/free-vector/colleagues-discussing-accounting-statistics-report-using-software_7732688.htm#page=2&query=landing%20page%20background%20employees%20calculation&position=24&from_view=search&track=ais&uuid=04ba5361-79d4-4b8c-bad6-4c00adf51cb8">Image by pch.vector</a> on Freepik
            </div>
            <div class="card-body p-4">
                <h3 class="card-title" style="font-weight: 900">SWM Calculator</h3>
                <h6 class="card-text">WELCOME TO MY LIBRARY OF TOOLS AND REFERENCES.</h6>
                <a role="button" href="{{route("home")}}" class="btn btn-lg btn-outline-success mt-5">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
