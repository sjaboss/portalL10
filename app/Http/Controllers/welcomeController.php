<?php

namespace App\Http\Controllers;

use App\Models\Red;
use App\Models\Baner;
use App\Models\Logo;
use App\Models\Video;
use App\Models\Noticia;
use App\Models\Seccion;
use App\Models\Publicidad;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class welcomeController extends Controller
{


    public function __invoke()
    {
        try {
            $publicidades = Publicidad::orderBy('orden', 'desc')->get();
            $noticias = Noticia::orderBy('fecha', 'desc')->limit(10)->get();
            $secciones = Seccion::orderBy('orden', 'desc')->get();
            $videos = Video::orderBy('orden', 'desc')->limit(3)->get();
            $baners = Baner::orderBy('orden', 'asc')->limit(3)->get();
            $redes = Red::orderBy('orden', 'desc')->get();
            $logos = Logo::orderBy('id', 'desc')->limit(1)->get();
            
            return view('welcome', compact('publicidades', 'noticias', 'secciones', 'videos', 'baners', 'redes', 'logos'));
        } catch (\Exception $e) {
            Log::error('Error en welcomeController: ' . $e->getMessage());
            return view('welcome')->with('error', 'Ha ocurrido un error al cargar la página');
        }
    }



}
