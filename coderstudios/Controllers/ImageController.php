<?php

namespace CoderStudios\Controllers;

use CoderStudios\Helpers\ImageHelper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends BaseController
{
    public function __construct(ImageHelper $image, Filesystem $file, Request $request)
    {
        $this->image = $image;
        $this->file = $file;
        $this->request = $request;
    }

    public function index()
    {
        $user_id = '';
        $width = 100;
        $height = 100;
        $filename = 'bolt-logo-128x128.png';
        $folder = '';

        if ($this->request->input('filename')) {
            $filename = $this->request->input('filename');
        }

        if ($this->request->input('folder')) {
            $folder = $this->request->input('folder');
        }

        if ($this->request->input('user_id')) {
            $user_id = $this->request->input('user_id');
        }

        if (empty($user_id) && $this->request->input('id')) {
            $user_id = $this->request->input('id');
        }

        if ($this->request->input('width')) {
            $width = $this->request->input('width');
        }

        if ($this->request->input('height')) {
            $height = $this->request->input('height');
        }

        if (empty($folder) && !empty($user_id)) {
            $folder = $user_id;
        }

        $image = $this->image->resize($folder, $filename, $width, $height);

        if (!$image && !empty($user_id)) {
            $image = $this->image->resize($user_id, $filename, $width, $height);
        }

        $info = pathinfo($image);
        $extension = isset($info['extension']) ? $info['extension'] : 'png';
        $image = $this->file->get($image);

        return (new Response($image, 200))
            ->header('Content-Type', 'image/'.$extension)
        ;
    }
}
