<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Seccion;
use App\Models\Publicidad;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class SeccionsepController extends Controller
{


   public function index($seccion, Request $request)
    {
        $seccion_obj = Seccion::where('seccion', $seccion)->first();
        $secciones = Seccion::all();
        $publicidades = Publicidad::all();

        if ($seccion_obj) {
            $noticias = Noticia::where('seccion_id', $seccion_obj->id);


            // Filtrado por título
            if ($request->has('titulo')) {
                $noticias = $noticias->where('titulo', 'LIKE', "%" . $request->input('titulo') . "%");
            }

            // Filtrado por fecha
         /*    if ($request->has('fecha')) {
                $noticias = $noticias->where('fecha', $request->input('fecha'));
            } */

            // Paginación
            $noticias = $noticias->orderBy('fecha', 'desc')
                ->paginate(3);

            return view('noticiaSep.index', compact('seccion_obj', 'noticias', 'secciones', 'publicidades'));
        } else {
            // Mostrar un mensaje de error o redirigir a otra página
            return redirect()->route('home')->withErrors('Sección no encontrada');

        }
    }
}
