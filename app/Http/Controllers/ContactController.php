<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function __construct()
    {
        // La ruta de creación y almacenamiento de contactos debe ser pública
        $this->middleware('auth')->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(request()->ajax()) {
            return view('contacts.form');
        }
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Solicitud recibida:', $request->all());

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'message' => 'required|string'
            ]);

            Log::info('Datos validados:', $validated);

            $contact = Contact::create($validated);

            Log::info('Contacto creado:', ['id' => $contact->id]);

            if($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Mensaje enviado correctamente'
                ]);
            }

            return redirect()->route('contacts.index')
                ->with('success', 'Mensaje enviado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error en store:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al enviar el mensaje: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'Error al enviar el mensaje']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->update(['status' => 'read']);
        return view('contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')
            ->with('success', 'Mensaje eliminado correctamente.');
    }
}
