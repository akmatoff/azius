@php
    $locale = app()->getLocale();

    $data = json_decode(file_get_contents(storage_path('content/general.json')), true);
    $hero = json_decode(file_get_contents(storage_path('content/hero-section.json')), true);
    $about = json_decode(file_get_contents(storage_path('content/about-section.json')), true);
    $work = json_decode(file_get_contents(storage_path('content/work-section.json')), true);
    $footer = json_decode(file_get_contents(filename: storage_path(path: 'content/footer.json')), true);

    $data = $data[$locale] ?? $data['ru'];
    $hero = $hero[$locale] ?? $hero['ru'];
    $about = $about[$locale] ?? $about['ru'];
    $work = $work[$locale] ?? $work['ru'];
    $footer = $footer[$locale] ?? $footer['ru'];

@endphp

<x-admin-layout>
    <main class="space-y-4 p-8">
        <!-- Tab buttons -->
        <ul class="flex border-b">
            <li>
                <button type="button" class="tab-btn active px-4 py-2" data-tab="general">Общие данные</button>
            </li>
            <li>
                <button type="button" class="tab-btn px-4 py-2" data-tab="hero">Главный раздел</button>
            </li>
            <li>
                <button type="button" class="tab-btn px-4 py-2" data-tab="about">О нас</button>
            </li>
            <li>
                <button type="button" class="tab-btn px-4 py-2" data-tab="work">Сферы деятельности</button>
            </li>
            <li>
                <button type="button" class="tab-btn px-4 py-2" data-tab="contacts">Контакты</button>
            </li>
        </ul>

        <!-- Tab content -->
        <div id="general" class="tab-content block p-4">
            <x-input-label>Название</x-input-label>
            <x-text-input value="{{ $data['title'] }}"></x-text-input>
        </div>

        <div id="hero" class="tab-content hidden p-4">
            Content for Tab 2
        </div>

        <div id="about" class="tab-content hidden p-4">
            Content for Tab 3
        </div>

        <div id="work" class="tab-content hidden p-4">
            Content for Tab 3
        </div>

        <div id="contacts" class="tab-content hidden p-4">
            Content for Tab 3
        </div>
    </main>

    <script>
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tab = button.getAttribute('data-tab');

                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(tc => {
                    tc.classList.add('hidden');
                    tc.classList.remove('block');
                });

                // Remove active from all buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('active');
                });

                // Show selected tab content
                document.getElementById(tab).classList.remove('hidden');
                document.getElementById(tab).classList.add('block');

                // Mark clicked button active
                button.classList.add('active');
            });
        });
    </script>

    <style>
        .active {
            border-bottom: 2px solid blue;
            font-weight: bold;
        }
    </style>

</x-admin-layout>
