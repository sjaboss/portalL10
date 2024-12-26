<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Sube una imagen
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $urls = $this->imageService->saveImage(
                $request->file('image'),
                'uploads',
                [
                    'thumb' => [150, 150],
                    'medium' => [300, 300],
                    'large' => [800, 800]
                ]
            );

            return response()->json([
                'success' => true,
                'urls' => $urls
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se encontró ninguna imagen'
        ], 400);
    }

    /**
     * Elimina una imagen
     */
    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        $success = $this->imageService->deleteImage($request->path);

        return response()->json([
            'success' => $success
        ]);
    }
}
