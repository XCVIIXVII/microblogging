<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 relative min-h-screen">
    <!-- Header Section -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <img src="{{ asset('assets/icons/MSU_logo.png') }}" alt="Logo" style="width: 10%; height: auto;" class="mr-2">
                    <h1 class="text-3xl font-bold text-red-500">MSU Lodge</h1>
                </div>
                <nav class="flex items-center">
                    <a href="#about" class="text-black hover:text-red-500 font-medium px-4">About</a>
                    <a href="#features" class="text-black hover:text-red-500 font-medium px-4">Features</a>
                    <a href="{{ route('login') }}" class="text-black hover:text-red-500 font-medium px-4">Login</a>
                    <a href="{{ route('register') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2 whitespace-nowrap">Sign Up</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-red-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-5xl font-extrabold text-gray-900 mb-6">Welcome to MSU Lodge</h2>
            <p class="text-lg text-gray-700 mb-8 max-w-3xl mx-auto">
                A place where students and lecturers connect, collaborate, and create opportunities.
                Join the conversation and stay engaged with the MSU community.
            </p>
            <div>
                <a href="{{ route('register') }}" class="bg-red-500 text-white px-6 py-3 rounded-lg shadow hover:bg-red-600">Join Now</a>
                <a href="{{ route('login') }}" class="ml-4 text-black font-medium hover:text-red-500">Already a member?</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-gray-900 mb-12 text-center">Why Join MSU Lodge?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <h4 class="text-2xl font-bold text-red-500 mb-4">Collaborate on Projects</h4>
                    <p class="text-gray-600">Work together with classmates and faculty on exciting new projects and research.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <h4 class="text-2xl font-bold text-red-500 mb-4">Stay Updated</h4>
                    <p class="text-gray-600">Get the latest news and announcements from the MSU community.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                    <h4 class="text-2xl font-bold text-red-500 mb-4">Network and Grow</h4>
                    <p class="text-gray-600">Connect with peers, mentors, and alumni to expand your professional network.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-gray-900 mb-12 text-center">What Our Members Say</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <p class="text-gray-700 mb-4 italic">"MSU Lodge has made it so easy to collaborate with my peers. I feel more connected than ever!"</p>
                    <h5 class="font-bold text-red-500">- Aisyah, Engineering Student</h5>
                </div>
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <p class="text-gray-700 mb-4 italic">"Great platform for staying informed and networking with fellow lecturers and students."</p>
                    <h5 class="font-bold text-red-500">- Mr. Rahman, Lecturer</h5>
                </div>
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <p class="text-gray-700 mb-4 italic">"I love how easy it is to share ideas and discuss topics that matter to us."</p>
                    <h5 class="font-bold text-red-500">- Sarah, Business Student</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-red-500 py-16 text-center">
        <h3 class="text-4xl font-bold text-white mb-6">Ready to Join MSU Lodge?</h3>
        <p class="text-white mb-8">Sign up today and become part of a thriving academic community!</p>
        <a href="#signup" class="bg-white text-red-500 px-6 py-3 rounded-lg shadow hover:bg-gray-200">Sign Up Now</a>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 MSU Lodge. All rights reserved.</p>
            <div class="mt-4">
                <a href="#privacy" class="text-gray-400 hover:text-white mx-2">Privacy Policy</a>
                <a href="#terms" class="text-gray-400 hover:text-white mx-2">Terms of Service</a>
            </div>
        </div>
    </footer>
    </body>
</html>
