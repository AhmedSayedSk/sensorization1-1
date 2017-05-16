<?php

namespace App\Logic\Image;

use Validator;
use Response;
use Config;
use File;

use Intervention\Image\ImageManager;
use App\Models\Product\Image;

class ImageRepository
{
    public function upload($form_data)
    {
        $validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {
            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);
        }

        $photo = $form_data['file'];
        $parent_id = $form_data['parent_id'];

        $currentCount = Image::where('parent_id', $parent_id)->count();
        $max_uploads = Config::get('images.max_uploads');

        if($currentCount >= $max_uploads){
            return Response::json([
                'error' => true,
                'message' => trans("sub_validation.image.max_uplaod", ['number' => $max_uploads]),
                'code' => 400
            ], 400);
        }

        $extension = $photo->getClientOriginalExtension();
        $image_name = time() .'-'. rand(10000, 99999) .'-'. $parent_id .'.'. $extension;

        $uploadSuccess1 = $this->original($photo, $image_name);
        $uploadSuccess2 = $this->icon($photo, $image_name);

        if(!$uploadSuccess1 || !$uploadSuccess2) {
            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);
        }

        $sessionImage = new Image;
        $sessionImage->parent_id = $parent_id;
        $sessionImage->image_name = $image_name;
        $sessionImage->save();

        return Response::json([
            'error' => false,
            'code'  => 200,
            'filename' => $image_name
        ], 200);
    }

    /**
     * Optimize Original Image
     */
    public function original($photo, $filename)
    {
        $manager = new ImageManager();
        $image = $manager->make($photo)->save(Config::get('images.full_size') . $filename);
        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon($photo, $filename)
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
            })
            ->save(Config::get('images.icon_size')  . $filename);

        return $image;
    }

    /**
     * Delete ProductImage From Session folder, based on server created filename
     */
    public function delete($filename)
    {
        $full_size_dir = Config::get('images.full_size');
        $icon_size_dir = Config::get('images.icon_size');

        $sessionImage = Image::where('image_name', $filename)->first();

        if(empty($sessionImage)) {
            return Response::json([
                'error' => true,
                'code'  => 400,
                'message' => $filename
            ], 400);
        }

        $full_path1 = $full_size_dir . $sessionImage->image_name;
        $full_path2 = $icon_size_dir . $sessionImage->image_name;

        if(File::exists($full_path1)) {
            File::delete($full_path1);
        }

        if(File::exists($full_path2)) {
            File::delete($full_path2);
        }

        if(!empty($sessionImage)) {
            $sessionImage->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }
}