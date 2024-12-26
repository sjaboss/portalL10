<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::orderBy('fecha', 'desc')->get();

        foreach ($videos as $video) {
            $video->fecha = Carbon::parse($video->fecha)->format('d/m/Y');
        }
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $videos = Video::all();
        return view('videos.create', compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
              // Validación de los datos recibidos
            $request->validate([
                'fecha'=> 'required|date', // fecha de la nota
                'titulo' => 'required|string|max:25', // titulo requerido
                'orden' => 'required|integer', // orden requerido
                'pie' => 'required|string|max:30', // pie requerido
                'src' => 'required|string', // url requerido
            ]);

            // Creación del nuevo usuario con los datos validados
            Video::create([
                'fecha' => $request->fecha,
                'titulo' => $request->titulo,
                'orden' => $request->orden,
                'pie' => $request->pie,
                'src' => $request->src
            ]);
    
            // Redirigir a la lista de usuarios con un mensaje de éxito
            return redirect()->route('videos.index')->with('success', 'Registro Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar la noticia por su ID
        $videos = Video::findOrFail($id);
        // Devolver la vista de edición con los datos del usuario y los roles
        return view('videos.edit', compact('videos'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        {
            $request->validate([
                'fecha'=> 'required|date', // fecha de la nota
                'titulo' => 'required|string|max:25', // titulo requerido
                'orden' => 'required|integer', // orden requerido',
                'pie' => 'required|string|max:30', // pie requerido
                'src' => 'required|string', // url requerido
            ]);

            // Encontrar el usuario por su ID
            $videos = Video::findOrFail($id);
            // Actualización de los datos del usuario
            $videos->update([
            'fecha' => $request->fecha,
            'titulo' => $request->titulo,
            'orden' => $request->orden,
            'pie' => $request->pie,
            'src' => $request->src,
            ]);

            // Redirigir a la lista de usuarios con un mensaje de éxito
            return redirect()->route('videos.index')->with('success', 'Registro Actualizado Correctamente');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $videos = Video::findOrFail($id);
        // Eliminar
        $videos->delete();
        return redirect()->route('videos.index')->with('success', 'Registro Eliminado Correctamente');
    }
}
