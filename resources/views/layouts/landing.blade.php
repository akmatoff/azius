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

    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>

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
        <header class="fixed flex items-center justify-center p-4 w-full text-white">
            <div class="flex items-center justify-between w-full px-8 py-5 space-x-4 rounded-xl lg:space-x-24 bg-[#232325] backdrop-blur-md bg-opacity-70">
                <a href="#hero-section" class="block cursor-pointer text-2xl font-bold text-primary">
                    AZIUS
                </a>

                <div class="flex items-center space-x-8">
                    @foreach ($navigation as $nav)
                    <a href="{{ $nav['url'] }}" class="text-gray-200 hover:text-white duration-300">
                        {{ $nav['title'] }}
                    </a>
                    @endforeach
                </div>

                <div class="flex items-center space-x-6">
                    @foreach ($socials as $social)
                    <a href="{{ $social['url'] }}" target="_blank" class="grid place-content-center text-gray-200 text-2xl hover:text-white duration-300">
                        <iconify-icon icon="{{ $social['icon'] }}" noobserver></iconify-icon>
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
