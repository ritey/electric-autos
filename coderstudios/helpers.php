<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

function ddSQL($query)
{
    if ('production' != config('app.env')) {
        if ($query->getBindings()) {
            dd(Str::replaceArray('?', $query->getBindings(), $query->toSql()));
        }
        dd($query->toSql());
    }
}

function ddx($o)
{
    \Log::info(print_r($o, true));
    dd($o);
}

function getFlagImageUrl($language)
{
    $flag = $language;
    if ('en' == $language) {
        $flag = 'gb';
    }
    if ('el' == $language) {
        $flag = 'gr';
    }

    return 'https://raw.githubusercontent.com/lipis/flag-icons/main/flags/1x1/'.$flag.'.svg';
}

function available_languages()
{
    return [
        'en',
        'fr',
        'de',
        'es',
        'el',
    ];
}

function getPrice()
{
    if (session()->has('price')) {
        return session()->get('price');
    }

    $settingLibrary = app(\CoderStudios\Libraries\SettingsLibrary::class);
    $price = $settingLibrary->getByName('price') ?? '85.00';
    session()->put('price', $price);

    return $price;
}

function doWebP($path = '', $width = '', $height = '')
{
    $image = null;
    $webp_path = $path;
    $resized_file = $path;
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    if (file_exists(public_path($path))) {
        if ('webp' == $ext) {
            return $path;
        }

        $webp_path = str_replace('storage/images/', 'storage/images/webp/', $path);
        if (!file_exists($webp_path)) {
            try {
                $image = Image::make(public_path($path))->orientate()->save(public_path($path));
            } catch (\Exception $e) {
                // \Log::info($path);
            }
        }
        $webp_path = str_replace('storage/images/', 'storage/images/webp/', $path);
        $basename = basename($webp_path);
        $basename_array = explode('.', basename($webp_path));
        $extension = $basename_array[count($basename_array) - 1];
        $webp_path = str_replace('.'.$extension, '.webp', $webp_path);
        $webp_path_base = $webp_path;
        $webp_path = storage_path('app/public'.str_replace('storage/', '', $webp_path));
        $old_filename = basename($webp_path);
        $old_path_filename = basename($path);
        if (!empty($width)) {
            $new_resized_filename = str_replace('.', 'x'.$width.'.', $old_filename);
            $new_org_resized_filename = str_replace('.', 'x'.$width.'.', $old_path_filename);
            $resized_file = str_replace($old_filename, $new_resized_filename, $webp_path);
            $resized_path = str_replace($old_path_filename, $new_org_resized_filename, $path);
        }

        if (!file_exists($webp_path) || (!empty($width) && !file_exists($resized_file))) {
            if (is_object($image) && !empty($width)) {
                $actual_width = $image->width();
                $actual_height = $image->height();
                if ($actual_width > $width) {
                    $aspectRatio = $actual_width / $actual_height;
                    if ($aspectRatio >= 1.0) {
                        $newWidth = $width;
                        $newHeight = $width / $aspectRatio;
                    } else {
                        $newWidth = $width * $aspectRatio;
                        $newHeight = $width;
                    }
                    $image = Image::make(public_path($path))->resize($newWidth, $newHeight)->save(public_path($resized_path));
                    $file = new UploadedFile(public_path($resized_path), basename($resized_path));
                    Webp::make($file)->save($resized_file, 70);
                }
            } else {
                $file = new UploadedFile(public_path($path), basename($path));
                Webp::make($file)->save($webp_path, 70);
            }
        }
        if (!empty($width)) {
            $webp_path = str_replace(basename($webp_path_base), str_replace('.', 'x'.$width.'.', basename($webp_path_base)), $webp_path_base);
        } elseif (!file_exists($webp_path)) {
            $webp_path = $path;
        } else {
            $webp_path = $webp_path_base;
        }
    }

    return $webp_path;
}
