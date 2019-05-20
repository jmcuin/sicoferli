<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HistorialAlumno;

class HistorialAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        //$this -> middleware(['auth', 'roles:administracion_sitio,direccion_general,direccion_nivel,profesor,administracion,asistencia_administrativa,alumno']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $historial_alumno = HistorialAlumno::findOrFail($id);
        
        return view('Trabajador.editHistorial', compact('historial_alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $historial_alumno = HistorialAlumno::findOrFail($id);
        $historial_alumno -> narrativa = $request -> narrativa;
        
        $guardado = $historial_alumno -> save();
        if($guardado)
            return redirect()->route('Inscripcion.index')->with('info','Comentario actualizado con éxito.');
        else
            return redirect()->route('Inscripcion.index')->with('error','Imposible actualizar Comentario.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
