@php
$data = json_decode(file_get_contents(storage_path('content/general.json')), true);
$hero = json_decode(file_get_contents(storage_path('content/hero-section.json')), true);
$about = json_decode(file_get_contents(storage_path('content/about-section.json')), true);
$work = json_decode(file_get_contents(storage_path('content/work-section.json')), true);
$footer = json_decode(file_get_contents(filename: storage_path(path: 'content/footer.json')), true);
@endphp

<x-landing-layout>
    <div class="fixed top-0 left-0 bottom-0 right-0 -z-10" style="background-attachment: fixed; background-image: url('{{ $hero['background_image']['src'] ?? 'images/hero-img.jpeg' }}'); background-size: cover; background-position: center; background-color: {{ $hero['background_color'] }}"></div>

    <section id={{ $hero['id'] ?? 'hero-section' }} class="min-h-screen flex flex-col justify-center items-center px-4">
        <div class="lg:w-9/12 mx-auto">
            <div class="text-center space-y-6">
                <img src="{{ $hero['logo']['src'] ?? 'images/hero-logo.png' }}" alt="{{ $hero['logo']['alt'] ?? 'Azius Logo' }}" class="w-5/12 mx-auto">
                {{-- <h1 class="text-8xl font-bold text-white">{{ $hero['title'] ?? '' }}</h1> --}}
                <p class="text-[48px] text-white">
                    {{ $hero['subtitle'] }}</p>
            </div>
        </div>

    </section>

    <div class="bg-gray-100">

        <section id={{ $about['id'] ?? 'about-section' }} class="min-h-screen flex flex-col items-center justify-center py-12 px-4">
            <div class="lg:w-9/12 space-y-8">
                <div class="mx-auto">
                    <div class="space-y-6">
                        <h1 class="text-4xl font-bold">{{ $about['title'] ?? 'О нас' }}</h1>
                        <p class="text-lg text-gray-600">{{ $about['description'] ?? 'Learn more about our mission and values.' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
                    @foreach ($about['items'] as $item)
                    <div class="flex flex-col items-center bg-white rounded-xl p-6 shadow-sm space-y-2">
                        @isset($item['icon'])
                        <iconify-icon icon="{{ $item['icon'] }}" class="text-8xl my-8 text-gray-400"></iconify-icon>
                        @endisset
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
            <div class="lg:w-9/12 space-y-8">

                <div class="mx-auto">
                    @if (!empty($work['title']))
                    <h1 class="text-4xl font-bold">{{ $work['title'] }}</h1>
                    @endif
                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach ($work['items'] as $item)
                    <div style="background: url({{$item['image']}}); background-position: center; background-size: cover;" class="flex flex-col justify-end h-[480px] lg:h-[380px] p-1 rounded-xl shadow-sm cursor-pointer hover:scale-[1.03] hover:shadow-md duration-500">
                        <div class="p-4 space-y-2 bg-gray-600 rounded-xl bg-opacity-35 backdrop-blur-2xl hover:bg-opacity-90 duration-500">
                            <h1 class="text-2xl text-white font-bold">{{ $item['title'] }}</h1>
                            <p class="text-gray-100">{{ $item['description']}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <footer id="footer" class="flex justify-center py-12">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 p-4 lg:w-9/12">
                @foreach ($footer['items'] as $item)
                <div class="flex items-center space-x-4 bg-white px-8 rounded-xl duration-500 hover:scale-[1.02]">
                    <iconify-icon icon="{{ $item['icon'] }}" class="text-5xl my-8 text-gray-400"></iconify-icon>
                    <p class="text-gray-700">{{ $item['value'] }}</p>
                </div>
                @endforeach
            </div>
        </footer>
    </div>

</x-landing-layout>
