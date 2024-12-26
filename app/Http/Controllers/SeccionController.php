<?php

namespace App\Http\Controllers;

use App\Models\Seccion;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SeccionController extends Controller
{
    protected $imageService;
    protected $imageManager;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->imageManager = new ImageManager(new Driver());
        
        // Aplicar middleware de autenticación a todas las rutas
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los seccion
        $secciones = Seccion::all();
        // Devolver la vista con las secciones listados
        return view('secciones.index', compact('secciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Devolver la vista con las secciones listados
        return view('secciones.create');
    }

    protected function processIcon($request)
    {
        $iconData = [];
        Log::info('Processing icon with request data:', $request->all());

        if ($request->hasFile('icon')) {
            Log::info('Processing uploaded image');
            try {
                // Procesar la imagen con el servicio
                $urls = $this->imageService->saveImage(
                    $request->file('icon'),
                    'icons', // Asegurarse de que se use la carpeta 'icons'
                    [
                        'thumb' => [100, 100],
                        'medium' => [300, 300],
                        'large' => [600, 600]
                    ]
                );

                Log::info('Image URLs:', $urls);

                // Guardar solo los nombres de archivo, no las rutas completas
                $iconData = [
                    'icon' => basename($urls['original']),
                    'icon_thumb' => basename($urls['thumb']),
                    'icon_medium' => basename($urls['medium']),
                    'icon_large' => basename($urls['large']),
                    'font_awesome_icon' => null
                ];

                Log::info('Icon data after processing:', $iconData);
            } catch (\Exception $e) {
                Log::error('Error processing image: ' . $e->getMessage());
                throw $e;
            }
        } elseif ($request->filled('font_awesome_icon')) {
            $faIcon = trim($request->input('font_awesome_icon')); // Eliminar espacios en blanco
            Log::info('Processing Font Awesome icon:', ['icon' => $faIcon]);
            
            // Limpiar cualquier dato de imagen anterior y establecer el icono de Font Awesome
            $iconData = [
                'icon' => null,
                'icon_thumb' => null,
                'icon_medium' => null,
                'icon_large' => null,
                'font_awesome_icon' => $faIcon
            ];
            
            Log::info('Font Awesome icon data:', $iconData);
        }

        Log::info('Final icon data:', $iconData);
        return $iconData;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Starting store method with request data:', $request->all());
        
        $request->validate([
            'seccion' => 'required|max:255|unique:secciones,seccion',
            'orden' => 'required|integer|unique:secciones,orden',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'font_awesome_icon' => 'nullable|string'
        ], [
            'seccion.unique' => 'Ya existe una sección con este nombre.',
            'orden.unique' => 'Ya existe una sección con este orden.',
        ]);

        try {
            // Obtener los datos básicos
            $data = $request->only(['seccion', 'orden', 'color', 'font_awesome_icon']);
            Log::info('Base data:', $data);
            
            // Si hay un archivo de icono, procesar la imagen
            if ($request->hasFile('icon')) {
                $iconData = $this->processIcon($request);
                Log::info('Icon data after processing:', $iconData);
                $data = array_merge($data, $iconData);
            }
            
            Log::info('Final data before create:', $data);

            $seccion = Seccion::create($data);
            Log::info('Created section:', $seccion->toArray());

            return redirect()->route('secciones.index')
                ->with('success', 'Sección creada exitosamente.');
        } catch (\Exception $e) {
            Log::error('Error creating section: ' . $e->getMessage());
            return back()->with('error', 'Error al crear la sección: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($seccion)
    {
        // Buscar la sección por su nombre
        $seccion = Seccion::where('seccion', $seccion)->firstOrFail();
        
        // Obtener las noticias relacionadas con esta sección
        $noticias = $seccion->noticias()->orderBy('created_at', 'desc')->get();
        
        return view('secciones.show', compact('seccion', 'noticias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar la seccion por su ID
        $seccion = Seccion::findOrFail($id);
        return view('secciones.edit', compact('seccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'seccion' => 'required|max:255',
                'orden' => 'required|integer',
                'color' => 'nullable|string|max:7',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'font_awesome_icon' => 'nullable|string'
            ]);

            // Encontrar la sección por su ID
            $seccion = Seccion::findOrFail($id);

            // Preparar los datos para actualizar
            $updateData = [
                'seccion' => $request->seccion,
                'orden' => $request->orden,
                'color' => $request->color,
                'font_awesome_icon' => $request->font_awesome_icon
            ];

            // Si se sube un nuevo icono
            if ($request->hasFile('icon')) {
                // Eliminar imágenes anteriores si existen
                if ($seccion->icon) {
                    Storage::delete([
                        'public/icons/' . basename($seccion->icon),
                        'public/icons/' . basename($seccion->icon_thumb),
                        'public/icons/' . basename($seccion->icon_medium),
                        'public/icons/' . basename($seccion->icon_large)
                    ]);
                }

                // Procesar y guardar el nuevo icono
                $iconData = $this->processIcon($request);
                if ($iconData) {
                    $updateData = array_merge($updateData, $iconData);
                    $updateData['font_awesome_icon'] = null;
                }
            }
            // Si se selecciona un icono de Font Awesome, limpiar las imágenes
            elseif ($request->filled('font_awesome_icon')) {
                $updateData['icon'] = null;
                $updateData['icon_thumb'] = null;
                $updateData['icon_medium'] = null;
                $updateData['icon_large'] = null;
            }

            // Actualizar la sección
            $seccion->update($updateData);

            return redirect()->route('secciones.index')
                ->with('success', 'Sección actualizada exitosamente.');

        } catch (\Exception $e) {
            Log::error('Error updating section: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar la sección: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrar la seccion por su ID
        $seccion = Seccion::findOrFail($id);
        
        // Eliminar imágenes si existen
        if ($seccion->icon) {
            Storage::delete([
                $seccion->icon,
                $seccion->icon_thumb,
                $seccion->icon_medium,
                $seccion->icon_large
            ]);
        }

        // Eliminar la seccion
        $seccion->delete();
        // Redirigir a la lista de secciones con un mensaje de éxito
        return redirect()->route('secciones.index')->with('success', 'Registro Eliminado Correctamente');
    }
}
