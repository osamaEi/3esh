<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Live Plus - Vendor Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="font-sans">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <a href="{{ url('/') }}"  class="h-12 w-12">
                <img src="{{asset('photos/logo.png')}}" alt="Live Plus Logo" class="h-15 w-15 p-1">
            </a>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-purple-700">Home</a>
                <a href="{{ url('/learn') }}" class="text-gray-700 hover:text-purple-700">Learn</a>
                <a href="{{ url('/faqs') }}" class="text-gray-700 hover:text-purple-700">FAQs</a>
                <a href="{{ url('/join') }}" class="text-gray-700 hover:text-purple-700">Join us</a>
            </nav>
            <a href="{{ url('/install') }}" class="bg-purple-700 text-white px-6 py-2 rounded-lg hover:bg-purple-800 transition duration-300">Install App</a>
        </div>
    </header>
