<?php

namespace App\Http\Controllers\Image;

use Bundle\Model\Image\CloudImage;
use Bundle\Model\Image\DatabaseImage;
use Bundle\ResponseApi\Response;
use Illuminate\Http\Request;

class ImageApi
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request): \Illuminate\Http\JsonResponse
    {
        $database = app()->make(DatabaseImage::class);
        $files = app()->make(CloudImage::class);
        $response = app()->make(Response::class);

        $images = $request->file('image');
        $service = $request->input('service');

        $dirFiles = $files->saveImage($images, $service);
        $result = $database->insert($dirFiles, $service);

        return response()->json(
            $response->add('response', $result)->response(), 200
        );
    }
}