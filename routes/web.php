<?php

use App\Models\Red;
use App\Models\Noticia;
use App\Models\Seccion;
use App\Models\Publicidad;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedController;
use App\Http\Controllers\FootController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BanerController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\welcomeController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PublicidadController;
use App\Http\Controllers\SeccionsepController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('secciones', SeccionController::class);
    Route::resource('noticias', NoticiaController::class)->except(['show']);
    Route::resource('publicidades', PublicidadController::class);
    Route::resource('historiales', HistorialController::class);
    Route::resource('videos', VideoController::class);
    Route::resource('baner', BanerController::class);
    Route::resource('redes', RedController::class);
    Route::resource('logos', LogoController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('reservations', ReservationController::class);
    Route::get('/reservations/pagos',[ReservationController::class,'showPayments'])->name('reservations.pagos');
    Route::get('/reservations/calendario',function(){
        return view('reservations.calendario');
    })->name('reservations.calendario');
    Route::get('administrador/fullcalendar',[ReservationController::class,'getAllReservations'])->name('administrador.fullcalendar');
});

Route::get('/', [welcomeController::class, '__invoke'])->name('home');
Route::get('/noticias/{noticia}', [NoticiaController::class, 'show'])->name('noticias.show');
Route::get('/seccion/{seccion}', [App\Http\Controllers\NoticiaController::class, 'showBySeccion'])->name('seccion');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::resource('contacts', ContactController::class);

require __DIR__.'/auth.php';
