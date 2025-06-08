@php
$data = json_decode(file_get_contents(storage_path('content/general.json')), true);
$title = $data['title'] ?? 'Azius';
$navigation = $data['navigation'] ?? [];
$socials = $data['socials'] ?? [];
$primaryColor = $data['primary_color'] ?? '#4F46E5';
$backgroundColor = $data['background_color'] ?? '#131313';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: {
                    {
                    $primaryColor
                }
            }

            ;

            --background-color: {
                    {
                    $backgroundColor
                }
            }

            ;
        }

        .text-primary {
            color: var(--primary-color);
        }

    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Page Heading -->
        <header class="fixed flex items-center justify-center py-4 bg lg:px-20 w-full">
            <div class="flex items-center justify-around w-full space-x-2 bg-gray-900 border shadow-sm rounded-full px-8 py-4 backdrop-blur-md bg-opacity-10">
                <div class="cursor-pointer text-2xl font-bold text-primary">
                    AZIUS
                </div>

                <div class="flex items-center space-x-8">
                    @foreach ($navigation as $nav)
                    <a href="{{ $nav['url'] }}" class="text-gray-500 hover:text-primary duration-300">
                        {{ $nav['title'] }}
                    </a>
                    @endforeach
                </div>

                <div class="flex items-center space-x-6">
                    @foreach ($socials as $social)
                    <a href="{{ $social['url'] }}" class="text-gray-500 hover:text-primary duration-300">
                        {{ $social['title'] }}
                        {{-- <i class="{{ $social['icon'] }}"></i> --}}
                    </a>
                    @endforeach
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
