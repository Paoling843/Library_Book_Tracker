<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Crimson+Pro:ital,wght@0,300;0,400;0,500;1,300;1,400&family=DM+Mono:wght@300;400&display=swap');
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#f0e8dc] dark:bg-[#17110d]">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#6a5040] dark:text-[#c49a6c]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-5 bg-[#fffdf9] dark:bg-[#1e1812] border border-[#e0d0bc] dark:border-[rgba(138,102,64,0.25)] shadow-[0_10px_26px_rgba(100,70,40,0.08)] rounded-[2px] overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
