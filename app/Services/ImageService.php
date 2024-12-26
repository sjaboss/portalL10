<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Guarda una imagen
     * 
     * @param mixed $image
     * @param string $path
     * @param array $sizes
     * @return array
     */
    public function saveImage($image, $path = 'images', $sizes = ['thumb' => [150, 150], 'medium' => [300, 300]])
    {
        Log::info('Starting saveImage', [
            'path' => $path,
            'sizes' => $sizes
        ]);

        // Generar nombre único
        $fileName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . '/' . $fileName;

        Log::info('Generated file name', ['fullPath' => $fullPath]);

        // Guardar imagen original
        $img = $this->manager->read($image);
        Storage::disk('public')->put($fullPath, $img->toJpeg());

        // Generar y guardar miniaturas
        $urls = ['original' => $fullPath];
        foreach ($sizes as $size => $dimensions) {
            $thumbPath = $path . '/' . $size . '_' . $fileName;
            
            // Obtener las dimensiones originales
            $originalWidth = $img->width();
            $originalHeight = $img->height();
            
            // Calcular el ratio de aspecto original
            $ratio = $originalWidth / $originalHeight;
            
            // Determinar las dimensiones finales manteniendo la proporción
            $targetWidth = $dimensions[0];
            $targetHeight = $dimensions[1];
            
            if ($ratio > 1) {
                // Imagen más ancha que alta
                $targetHeight = $targetWidth / $ratio;
            } else {
                // Imagen más alta que ancha
                $targetWidth = $targetHeight * $ratio;
            }
            
            $resized = $img->resize((int)$targetWidth, (int)$targetHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            Storage::disk('public')->put($thumbPath, $resized->toJpeg());
            $urls[$size] = $thumbPath;
        }

        Log::info('Generated URLs', $urls);
        return $urls;
    }

    /**
     * Elimina una imagen y sus miniaturas
     * 
     * @param string $filename
     * @param string $path
     * @return bool
     */
    public function deleteImage($filename, $path = 'images')
    {
        if (!$filename) return false;

        $paths = [
            $path . '/' . $filename,
            $path . '/thumb_' . $filename,
            $path . '/medium_' . $filename,
            $path . '/large_' . $filename
        ];

        foreach ($paths as $filePath) {
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        return true;
    }
}
