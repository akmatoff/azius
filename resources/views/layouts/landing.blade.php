@php
    $locale = app()->getLocale();

    $data = json_decode(file_get_contents(storage_path('content/general.json')), true);
    $title = $data['title'] ?? 'Azius';
    $navigation = $data[$locale]['navigation'] ?? [];
    $socials = $data[$locale]['socials'] ?? [];
    $primaryColor = $data['primary_color'] ?? '#4F46E5';
    $backgroundColor = $data['background_color'] ?? '#131313';
    $hero = json_decode(file_get_contents(storage_path('content/hero-section.json')), true);

    $data = $data[$locale] ?? $data['ru'];

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/lenis@1.3.4/dist/lenis.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    <script src="https://unpkg.com/lenis@1.3.4/dist/lenis.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

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
    <div class="min-h-screen">
        <!-- Page Heading -->
        <header class="fixed flex items-center justify-center p-4 w-full text-white z-20">
            <div
                class="flex items-center justify-between w-full px-8 py-4 space-x-4 rounded-xl lg:space-x-24 bg-[#232325] backdrop-blur-md bg-opacity-70">
                <a href="#hero-section" class="block cursor-pointer text-2xl font-bold text-primary">
                    <img src="{{ $data['logo'] }}" alt="Logo" class="w-20">
                </a>

                <div class="flex items-center space-x-8">
                    @foreach ($navigation as $nav)
                        <a href="{{ $nav['url'] }}" class="text-gray-200 hover:text-white duration-300">
                            {{ $nav['title'] }}
                        </a>
                    @endforeach
                </div>

                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-4">
                        @foreach ($socials as $social)
                            <a href="{{ $social['url'] }}" target="_blank"
                                class="grid place-content-center text-gray-200 text-3xl hover:text-white duration-300">
                                <iconify-icon icon="{{ $social['icon'] }}" noobserver></iconify-icon>
                            </a>
                        @endforeach
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('home', ['locale' => 'en']) }}"
                            class="border py-1 px-2 rounded-lg text-gray-200 hover:underline hover:text-white hover:border-white duration-500">EN</a>
                        <a href="{{ route('home', ['locale' => 'ru']) }}"
                            class="border py-1 px-2 rounded-lg text-gray-200 hover:underline hover:text-white hover:border-white duration-500">RU</a>
                    </div>
                </div>


            </div>
        </header>

        <!-- Page Content -->
        <main class="flex flex-col items-center">
            {{ $slot }}
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lenis = new Lenis({
                autoRaf: true,
                lerp: 0.12,
                smoothWheel: true
            });

        });
    </script>
</body>

</html>
