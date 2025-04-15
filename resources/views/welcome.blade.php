<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1>Welcome to Blog Application</h1>
                <p class="lead">A simple blog application built with Laravel</p>
                
                @guest
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <p class="mt-3">
                            Don't have an account? <a href="{{ route('register') }}">Register here</a>
                        </p>
                    </div>
                @else
                    <div class="mt-4">
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">Go to Admin Dashboard</a>
                        @else
                            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go to Home</a>
                        @endif
                    </div>
                @endguest
            </div>
        </div>
    </div>
</body>
</html> 