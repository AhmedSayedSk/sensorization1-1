<?php

namespace App\Http\Controllers\Uploads;

use App\Http\Controllers\Controller;
use App\Logic\Image\CarouselRepository;

use Illuminate\Support\Facades\Input;

use Response;

class CarouselController extends Controller
{
    protected $carousel;

    public function __construct(CarouselRepository $carouselRepository)
    {
        $this->carousel = $carouselRepository;
    }

    public function upload()
    {
        $photo = Input::all();
        $response = $this->carousel->upload($photo);
        return $response;
    }

    public function delete()
    {
        $filename = Input::get('id');
        if(!$filename) return 0;
        
        $response = $this->carousel->delete($filename);
        return $response;
    }
}