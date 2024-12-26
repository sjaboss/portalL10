<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Seccion;
use App\Models\Publicidad;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index(Request $request)
    {
        $secciones = Seccion::all();
        $publicidades = Publicidad::all();
    
        $noticias = Noticia::orderBy('fecha', 'desc');
    
        // Filtrado por fecha
        if ($request->has('fecha')) {
            $fecha = \Carbon\Carbon::parse($request->input('fecha'))->format('Y-m');
            $noticias = $noticias->whereRaw("DATE_FORMAT(fecha, '%Y-%m') = ?", $fecha);
        }
    
        $noticias = $noticias->paginate(3);
    
        return view('historial.index', compact('noticias', 'secciones', 'publicidades'));
    }
}