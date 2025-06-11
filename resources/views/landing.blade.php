@php
    use Illuminate\Support\Str;

    $data = json_decode(file_get_contents(storage_path('content/general.json')), true);
    $hero = json_decode(file_get_contents(storage_path('content/hero-section.json')), true);
    $about = json_decode(file_get_contents(storage_path('content/about-section.json')), true);
    $work = json_decode(file_get_contents(storage_path('content/work-section.json')), true);
    $footer = json_decode(file_get_contents(filename: storage_path(path: 'content/footer.json')), true);

    $work = json_decode(file_get_contents(storage_path('content/work-section.json')), true);

    // Parse markdown descriptions to HTML
    if (!empty($work['items'])) {
        foreach ($work['items'] as &$work_item) {
            $work_item['content_html'] = Str::markdown($work_item['content'] ?? '');
        }
    }
@endphp

<x-landing-layout>
    <div class="fixed top-0 left-0 bottom-0 right-0 -z-20"
        style="background-attachment: fixed; background-image: url('{{ $hero['background_image']['src'] ?? 'images/hero-img.jpeg' }}'); background-size: cover; background-position: center; background-color: {{ $hero['background_color'] }}">
    </div>
    <div class="fixed inset-0 -z-10 bg-gray-900 opacity-30"></div>

    <section id={{ $hero['id'] ?? 'hero-section' }} class="min-h-screen flex flex-col justify-center items-center px-4">
        <div class="lg:w-[62%] mx-auto">
            <div class="text-center space-y-6">
                <img src="{{ $hero['logo']['src'] ?? 'images/hero-logo.png' }}"
                    alt="{{ $hero['logo']['alt'] ?? 'Azius Logo' }}" class="w-5/12 mx-auto">
                {{-- <h1 class="text-8xl font-bold text-white">{{ $hero['title'] ?? '' }}</h1> --}}
                <p class="text-[48px]/[54px] text-white">
                    {{ $hero['subtitle'] }}</p>
            </div>
        </div>

    </section>

    <div class="bg-gray-100">

        <section id={{ $about['id'] ?? 'about-section' }} class="flex flex-col items-center justify-center py-12 px-4">
            <div class="lg:w-[62%] space-y-8">
                <div class="mx-auto">
                    <div class="space-y-3">
                        <h1 class="text-4xl font-bold">{{ $about['title'] ?? 'О нас' }}</h1>
                        <p class="text-xl text-gray-600">
                            {{ $about['description'] ?? 'Learn more about our mission and values.' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-2">
                    @foreach ($about['items'] as $item)
                        <div class="flex flex-col bg-white rounded-xl shadow-sm border">
                            @isset($item['icon'])
                                <div class="px-4 py-12 bg-slate-100 rounded-tl-xl rounded-tr-xl grid place-content-center">
                                    <iconify-icon icon="{{ $item['icon'] }}" class="text-8xl text-gray-500"></iconify-icon>
                                </div>
                            @endisset
                            <div class="p-5">
                                @if (!empty($item['title']))
                                    <h3 class="text-2xl font-semibold">{{ $item['title'] }}</h3>
                                @endif
                                <p class="text-gray-500 text-base">{{ $item['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="{{ $work['id'] ?? 'work-section' }}"
            class="flex flex-col items-center justify-center px-4 py-12 bg-gray-100" x-data="{ open: false, selectedItem: null }">
            <div class="lg:w-[62%] space-y-6">

                <div class="mx-auto">
                    @if (!empty($work['title']))
                        <h1 class="text-4xl font-bold">{{ $work['title'] }}</h1>
                    @endif
                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
                    @foreach ($work['items'] as $item)
                        <div style="background: url({{ $item['image'] }}); background-position: center; background-size: cover;"
                            class="flex flex-col justify-end h-[480px] lg:h-[380px] p-1 rounded-xl shadow-sm cursor-pointer hover:scale-[1.03] hover:shadow-md duration-500"
                            @click="selectedItem = {{ json_encode($item) }}; open = true">
                            <div
                                class="p-4 space-y-2 bg-gray-600 rounded-xl bg-opacity-35 backdrop-blur-2xl hover:bg-opacity-90 duration-500">
                                <h1 class="text-2xl/7 text-white font-bold">{{ $item['title'] }}</h1>
                                <p class="text-gray-100">{{ $item['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal -->
            <div x-show="open"
                class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 p-2 md:px-10 md:py-6"
                style="display: none;">
                <div class="bg-white rounded-lg h-full w-full p-4 md:p-8 relative shadow-sm border duration-500 transition-all md:w-[80%] lg:w-[65%] overflow-y-auto"
                    @click.away="open = false" @click.stop>
                    <button class="absolute top-5 right-5 text-gray-600 hover:text-gray-900 font-bold text-2xl"
                        @click="open = false" aria-label="Close modal"><iconify-icon
                            icon="ic:outline-close"></iconify-icon></button>

                    <template x-if="selectedItem">
                        <div class="space-y-2">
                            <h1 x-text="selectedItem.title" class="font-bold text-3xl"></h1>
                            <div x-html="selectedItem.content_html" class="text-lg text-gray-500">

                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </section>


        <footer id="footer" class="flex justify-center py-12">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 p-4 lg:w-[62%]">
                @foreach ($footer['items'] as $item)
                    <div
                        class="flex items-center space-x-4 bg-white px-8 rounded-xl duration-500 hover:scale-[1.02] shadow-sm border">
                        <iconify-icon icon="{{ $item['icon'] }}" class="text-5xl my-8 text-gray-400"></iconify-icon>
                        <p class="text-gray-700">{{ $item['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </footer>
    </div>

</x-landing-layout>
