<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function save(Request $request)
    {
        $locale = $request->input('locale', 'ru');

        $sections = ['general', 'hero', 'about', 'work', 'footer'];

        foreach ($sections as $section) {
            if ($request->has($section)) {
                $json = json_decode($request->input($section), true);
                $path = storage_path("content/{$section}-section.json");

                if (!file_exists($path)) {
                    file_put_contents($path, json_encode([$locale => $json], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                } else {
                    $data = json_decode(file_get_contents($path), true);
                    $data[$locale] = $json;
                    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }

                // Handle hero image upload
                if ($section === 'hero') {
                    foreach ($request->file('hero_images', []) as $key => $file) {
                        $filename = $file->store('public/uploads');
                        $jsonPath = str_replace(['[', ']'], '', $key); // e.g. backgroundImage.src
                        data_set($json, $jsonPath, Storage::url($filename));
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}
