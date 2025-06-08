@php
$data = json_decode(file_get_contents(storage_path('content/general.json')), true);
$hero = json_decode(file_get_contents(storage_path('content/hero-section.json')), true);
$about = json_decode(file_get_contents(storage_path('content/about-section.json')), true);
$work = json_decode(file_get_contents(storage_path('content/work-section.json')), true);
@endphp

<x-landing-layout>

    <section id={{ $hero['id'] ?? 'hero-section' }} class="min-h-screen flex flex-col justify-center items-center px-4" style="background-image: url('{{ $hero['background_image']['src'] ?? asset('images/hero-bg.jpg') }}'); background-size: cover; background-position: center; background-color: {{ $hero['background_color'] }}">
        <div class="lg:w-9/12 mx-auto">
            <div class="text-center space-y-6">
                <h1 class="text-6xl font-bold text-white">{{ $hero['title'] ?? '' }}</h1>
                <p class="text-xl text-gray-300">
                    {{ $hero['subtitle'] }}</p>
            </div>
        </div>

    </section>

    <section id={{ $about['id'] ?? 'about-section' }} class="min-h-screen flex flex-col items-center justify-center py-12 px-4 " style="background-color: {{ $about['background_color'] ?? '#f8f9fa' }};">
        <div class="lg:w-9/12 space-y-32">
            <div class="mx-auto">
                <div class="text-center space-y-6">
                    <h1 class="text-4xl font-bold">{{ $about['title'] ?? 'О нас' }}</h1>
                    <p class="text-lg text-gray-600">{{ $about['description'] ?? 'Learn more about our mission and values.' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($about['items'] as $item)
                <div class="bg-white border rounded-lg p-6 shadow-sm space-y-2">
                    @if (!empty($item['title']))
                    <h3 class="text-2xl font-semibold">{{ $item['title'] }}</h3>
                    @endif
                    <p class="text-gray-700">{{ $item['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id={{ $work['id'] ?? 'work-section' }} class="min-h-screen flex flex-col items-center justify-center px-4 py-12">
        <div class="lg:w-9/12">
            <div class="mx-auto text-center">
                @if (!empty($work['title']))
                <h1 class="text-4xl font-bold text-black">{{ $work['title'] }}</h1>
                @endif
            </div>
        </div>
    </section>

</x-landing-layout>
