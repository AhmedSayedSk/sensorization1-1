<?php

namespace App\Logic\Image;

use Validator;
use Response;
use Config;
use File;

use Intervention\Image\ImageManager;
use App\Models\Product\Carousel;

class CarouselRepository
{
    public function upload($form_data)
    {     
        $validator = Validator::make($form_data, Carousel::$rules, Carousel::$messages);

        if ($validator->fails()) {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);
        }

        $photo = $form_data['file'];
        $parent_id = $form_data['parent_id'];

        $currentCount = Carousel::where('parent_id', $parent_id)->count();
        $max_uploads = Config::get('carousel.max_uploads');

        if($currentCount >= $max_uploads){
            return Response::json([
                'error' => true,
                'message' => trans("sub_validation.carousel.max_uplaod", ['number' => $max_uploads]),
                'code' => 400
            ], 400);
        }

        $extension = $photo->getClientOriginalExtension();
        $carousel_name = time() .'-'. rand(10000, 99999) .'-'. $parent_id .'.'. $extension;

        $uploadSuccess1 = $this->original($photo, $carousel_name);
        $uploadSuccess2 = $this->icon($photo, $carousel_name);

        if(!$uploadSuccess1 || !$uploadSuccess2) {
            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);
        }

        $sessionImage = new Carousel;
        $sessionImage->parent_id = $parent_id;
        $sessionImage->carousel_name = $carousel_name;
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code'  => 200,
            'filename' => $carousel_name
        ], 200);
    }

    /**
     * Optimize Original Carousel
     */
    public function original($photo, $filename)
    {
        $manager = new ImageManager();
        $image = $manager->make($photo)->save(Config::get('carousel.larg_size') . $filename);
        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon($photo, $filename)
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->resize(320, null, function ($constraint) {
            $constraint->aspectRatio();
            })
            ->save(Config::get('carousel.small_size')  . $filename);

        return $image;
    }

    /**
     * Delete Carousel From Session folder, based on server created filename
     */
    public function delete($filename)
    {
        $larg_size_dir = Config::get('carousel.larg_size');
        $small_size_dir = Config::get('carousel.small_size');

        $sessionCarousel = Carousel::where('carousel_name', $filename)->first();

        if(empty($sessionCarousel)) {
            return Response::json([
                'error' => true,
                'code'  => 400,
                'message' => $filename
            ], 400);
        }

        $full_path1 = $larg_size_dir . $sessionCarousel->carousel_name;
        $full_path2 = $small_size_dir . $sessionCarousel->carousel_name;

        if(File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if(File::exists($full_path2)) {
            File::delete($full_path2);
        }

        if(!empty($sessionCarousel)) {
            $sessionCarousel->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }
}