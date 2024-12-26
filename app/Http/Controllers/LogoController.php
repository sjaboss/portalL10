<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LogoController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logos = Logo::all();
        return view('logos.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Starting store method with request data:', $request->all());
        
        $request->validate([
            'nombre' => 'required|max:255|unique:logos,nombre',
            'orden' => 'required|integer|unique:logos,orden',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nombre.unique' => 'Ya existe un logo con este nombre.',
            'orden.unique' => 'Ya existe un logo con este orden.',
            'foto.required' => 'La imagen es obligatoria.',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
            'foto.max' => 'La imagen no debe ser mayor a 2MB.'
        ]);

        try {
            $data = $request->only(['nombre', 'orden']);
            Log::info('Base data:', $data);

            if ($request->hasFile('foto')) {
                $urls = $this->imageService->saveImage(
                    $request->file('foto'),
                    'logos',
                    [
                        'thumb' => [100, 100],
                        'medium' => [300, 300],
                        'large' => [600, 600]
                    ]
                );

                Log::info('Image URLs:', $urls);

                $data = array_merge($data, [
                    'foto' => $urls['original'],
                    'foto_thumb' => $urls['thumb'],
                    'foto_medium' => $urls['medium'],
                    'foto_large' => $urls['large']
                ]);
            }

            Log::info('Final data before create:', $data);

            $logo = Logo::create($data);
            Log::info('Created logo:', $logo->toArray());

            return redirect()->route('logos.index')
                ->with('success', 'Logo creado exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error creating logo: ' . $e->getMessage());
            return back()->with('error', 'Error al crear el logo: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Logo $logo)
    {
        return view('logos.show', compact('logo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logo $logo)
    {
        return view('logos.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logo $logo)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'image_urls' => 'nullable|string',
        ]);

        try {
            // Actualizar la foto si fue proporcionada
            if ($request->hasFile('foto')) {
                // Eliminar imágenes anteriores
                if ($logo->foto) {
                    $this->imageService->deleteImage(str_replace('/storage/', '', $logo->foto));
                }

                // Procesar la nueva imagen
                $urls = $this->imageService->saveImage(
                    $request->file('foto'),
                    'logos',
                    [
                        'thumb' => [150, 120],
                        'medium' => [300, 300],
                        'large' => [800, 800]
                    ]
                );

                // Actualizar las URLs de las imágenes
                $logo->foto = $urls['original'];
                $logo->foto_thumb = $urls['thumb'];
                $logo->foto_medium = $urls['medium'];
                $logo->foto_large = $urls['large'];
            }

            // Actualizar el nombre
            $logo->nombre = $request->nombre;
            $logo->save();

            return redirect()->route('logos.index')
                ->with('success', 'Registro Actualizado Correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar el logo: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logo $logo)
    {
        try {
            // Eliminar las imágenes asociadas
            if ($logo->foto) {
                $this->imageService->deleteImage(str_replace('/storage/', '', $logo->foto));
            }

            // Eliminar el registro
            $logo->delete();

            return redirect()->route('logos.index')
                ->with('success', 'Registro Eliminado Correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar el logo: ' . $e->getMessage());
        }
    }
}
