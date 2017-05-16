<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use App\Logic\Image\ImageRepository;

use Illuminate\Support\Facades\Input;

use Response;

class ImageController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function upload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;
    }

    public function delete()
    {
        $filename = Input::get('id');
        if(!$filename) return 0;
        
        $response = $this->image->delete($filename);
        return $response;
    }
}