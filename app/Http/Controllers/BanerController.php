<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Baner;
use Illuminate\Http\Request;

class BanerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baners = Baner::orderBy('fecha', 'desc')->get();

        foreach ($baners as $baner) {
            $baner->fecha = Carbon::parse($baner->fecha)->format('d/m/Y');
        }
        return view('baner.index', compact('baners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $baners = Baner::all();
        return view('baner.create', compact('baners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'fecha' => 'required|date', // fecha de la nota
            'titulo' => 'required|string|max:45', // titulo requerido
            'orden' => 'required|integer', // orden requerido
            'pie' => 'required|string|max:60', // pie requerido
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048', // Foto opcional
        ]);

        // Almacenar la foto si fue proporcionada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public'); // Almacena la foto en el sistema de archivos
        }

        // Creación del nuevo usuario con los datos validados
        Baner::create([
            'fecha' => $request->fecha,
            'titulo' => $request->titulo,
            'orden' => $request->orden,
            'pie' => $request->pie,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('baner.index')->with('success', 'Registro Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Baner $baner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar la noticia por su ID
        $baner = Baner::findOrFail($id);
        return view('baner.edit', compact('baner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        {
            $request->validate([
                'fecha'=> 'required|date', // fecha de la nota
                'titulo' => 'required|string|max:45', // titulo requerido
                'orden' => 'required|integer', // orden requerido',
                'pie' => 'required|string|max:60', // pie requerido
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048', // Foto opcional
            ]);

            // Encontrar el usuario por su ID
            $baner = Baner::findOrFail($id);

            // Actualizar la foto si fue proporcionada
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('fotos', 'public');
                $baner->foto = $fotoPath;
            }

            // Actualización de los datos del usuario
            $baner->update([
                'fecha' => $request->fecha,
                'titulo' => $request->titulo,
                'orden' => $request->orden,
                'pie' => $request->pie,

            ]);

            // Redirigir a la lista de usuarios con un mensaje de éxito
            return redirect()->route('baner.index')->with('success', 'Registro Actualizado Correctamente');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrar el usuario por su ID
        $baner = Baner::findOrFail($id);
        // Eliminar el usuario
        $baner->delete();
        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('baner.index')->with('success', 'Registro Eliminado Correctamente');
    }
}
