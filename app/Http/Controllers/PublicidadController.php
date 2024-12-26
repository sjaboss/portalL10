<?php

namespace App\Http\Controllers;

use App\Models\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicidadController extends Controller
{
    /**
     * Muestra un listado de las publicidades.
     */
    public function index()
    {
        $publicidades = Publicidad::all();
        return view('publicidades.index', compact('publicidades'));
    }

    /**
     * Muestra el formulario para crear una nueva publicidad.
     */
    public function create()
    {
        return view('publicidades.create');
    }

    /**
     * Almacena una nueva publicidad en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Almacenar la foto si fue proporcionada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        // Creación de la publicidad con los datos validados
        Publicidad::create([
            'nombre' => $request->nombre,
            'foto' => $fotoPath,
        ]);

        // Redirigir a la lista de publicidades con mensaje de éxito
        return redirect()->route('publicidades.index')->with('success', 'Registro Creado Correctamente');
    }

    /**
     * Muestra una publicidad específica.
     */
    public function show(Publicidad $publicidad)
    {
        //
    }

    /**
     * Muestra el formulario para editar una publicidad.
     */
    public function edit($id)
    {
        $publicidad = Publicidad::findOrFail($id);
        return view('publicidades.edit', compact('publicidad'));
    }

    /**
     * Actualiza una publicidad específica en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'foto' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        // Buscar la publicidad por su ID
        $publicidad = Publicidad::findOrFail($id);

        // Actualizar la foto si se proporcionó una nueva
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($publicidad->foto) {
                Storage::disk('public')->delete($publicidad->foto);
            }
            $fotoPath = $request->file('foto')->store('fotos', 'public');
            $publicidad->foto = $fotoPath;
        }

        // Actualización de los datos
        $publicidad->update([
            'nombre' => $request->nombre,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('publicidades.index')->with('success', 'Registro Actualizado Correctamente');
    }

    /**
     * Elimina una publicidad específica de la base de datos.
     */
    public function destroy($id)
    {
        $publicidad = Publicidad::findOrFail($id);

        // Eliminar la foto si existe
        if ($publicidad->foto) {
            Storage::disk('public')->delete($publicidad->foto);
        }

        $publicidad->delete();

        return redirect()->route('publicidades.index')->with('success', 'Registro Eliminado Correctamente');
    }
}
