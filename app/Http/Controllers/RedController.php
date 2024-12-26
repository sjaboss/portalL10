<?php

namespace App\Http\Controllers;

use App\Models\Red;
use Illuminate\Http\Request;

class RedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $redes = Red::orderBy('orden', 'desc')->get();
            return view('redes.index', compact('redes'));

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $redes = Red::all();
        return view('redes.create', compact('redes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'titulo' => 'string|max:45', // titulo requerido
            'orden' => 'required|integer', // orden requerido
            'pie' => 'string', // pie requerido
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048', // Foto opcional
        ]);

        // Almacenar la foto si fue proporcionada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public'); // Almacena la foto en el sistema de archivos
        }

        // Creación del nuevo usuario con los datos validados
        Red::create([
            'titulo' => $request->titulo,
            'orden' => $request->orden,
            'pie' => $request->pie,
            'foto' => $fotoPath,
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('redes.index')->with('success', 'Registro Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Red $red)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar la noticia por su ID
        $red = Red::findOrFail($id);
        return view('redes.edit', compact('red'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { {
            $request->validate([
                'titulo' => 'string|max:45', // titulo requerido
                'orden' => 'required|integer', // orden requerido
                'pie' => 'string', // pie requerido
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048', // Foto opcional
            ]);

            // Encontrar el usuario por su ID
            $redes = Red::findOrFail($id);

            // Actualizar la foto si fue proporcionada
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('fotos', 'public');
                $redes->foto = $fotoPath;
            }

            // Actualización de los datos del usuario
            $redes->update([
                'titulo' => $request->titulo,
                'orden' => $request->orden,
                'pie' => $request->pie,

            ]);

            // Redirigir a la lista de usuarios con un mensaje de éxito
            return redirect()->route('redes.index')->with('success', 'Registro Actualizado Correctamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrar el usuario por su ID
        $redes = Red::findOrFail($id);
        // Eliminar el usuario
        $redes->delete();
        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('redes.index')->with('success', 'Registro Eliminado Correctamente');
    }
}
