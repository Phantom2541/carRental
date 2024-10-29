<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Car Rental</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
        }
        body {
            margin: 0;
            font-family: 'Nunito', sans-serif;
            background-image: url("https://img.freepik.com/premium-vector/modern-blue-white-abstract-presentation-background-with-corporate-concept_181182-16755.jpg?w=826");
            background-color: blue; 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat; 
            height: 100vh; /* Ensures the element takes full height */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white; /* Adjust text color for visibility */
        }
        .container {
            text-align: center; /* Center the text */
            position: relative; /* Needed for overlay */
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            z-index: 1; /* Ensures overlay is behind text */
        }
        h1 {
            position: relative; /* Position text above the overlay */
            z-index: 2; /* Ensures text is above the overlay */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Adds shadow for better visibility */
            margin-bottom: 20px; /* Space between title and links */
        }
        .auth-links {
            position: relative;
            z-index: 2; /* Ensures links are above the overlay */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7); /* Shadow for links */
        }
        .auth-links a {
            color: #3b82f6; /* Blue color for links */
            font-weight: 600; /* Increased font weight */
            text-decoration: none; /* Remove default underline */
            padding: 8px 12px; /* Padding for clickable area */
            border: 2px solid transparent; /* Initial border */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s, color 0.3s, border-color 0.3s; /* Smooth transitions */
        }
        .auth-links a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Light background on hover */
            color: #fff; /* White text on hover */
            border-color: #3b82f6; /* Blue border on hover */
            text-decoration: underline; /* Underline on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="overlay"></div> <!-- Semi-transparent overlay -->
        <h1 class="text-lg font-semibold mt-4">
            Car Rental Management System
        </h1>
        @if (Route::has('login'))
            <div class="auth-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
