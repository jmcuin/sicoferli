<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CriterioDesempenioRequest;
use App\CriterioDesempenio;

class CriterioDesempenioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this -> middleware(['auth', 'roles:administracion_sitio,direccion_general,direccion_nivel,profesor,administracion,asistencia_administrativa,alumno']);
    }
    
    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $criterios = CriterioDesempenio::where('criterio', 'like', '%'.$criterio.'%')
        ->orwhere('id_criterio_desempenio', $criterio)
        ->sortable()
        ->orderBy('id_criterio_desempenio')
        ->paginate(10);
        
        return view('CriterioDesempenio.index',compact('criterios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('CriterioDesempenio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriterioDesempenioRequest $request)
    {
        //
        $criterioD = new CriterioDesempenio;
        $criterioD -> criterio = $request -> criterio;
        $criterioD -> descripcion = $request -> descripcion;
        $criterioD -> porcentaje_examen = $request -> porcentaje_examen;
        $criterioD -> porcentaje_tareas = $request -> porcentaje_tareas;
        $criterioD -> porcentaje_tomas_clase = $request -> porcentaje_tomas_clase;
        $criterioD -> porcentaje_participacion = $request -> porcentaje_participacion;
        $guardado = $criterioD -> save();
        if($guardado)
            return redirect()->route('CriterioDesempenio.index')->with('info','Criterio creado con éxito.');
        else
            return redirect()->route('CriterioDesempenio.index')->with('error','Imposible guardar Criterio.');
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
        $criterioD = CriterioDesempenio::findOrFail($id);
        return view('CriterioDesempenio.show', compact('criterioD'));
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
        $criterioD = CriterioDesempenio::findOrFail($id);
        return view('CriterioDesempenio.edit', compact('criterioD'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CriterioDesempenioRequest $request, $id)
    {
        //
        $criterioD = CriterioDesempenio::findOrFail($id);
        $criterioD -> criterio = $request -> criterio;
        $criterioD -> descripcion = $request -> descripcion;
        $criterioD -> porcentaje_examen = $request -> porcentaje_examen;
        $criterioD -> porcentaje_tareas = $request -> porcentaje_tareas;
        $criterioD -> porcentaje_tomas_clase = $request -> porcentaje_tomas_clase;
        $criterioD -> porcentaje_participacion = $request -> porcentaje_participacion;
        $guardado = $criterioD -> save();
        if($guardado)
            return redirect()->route('CriterioDesempenio.index')->with('info','Criterio actualizado con éxito.');
        else
            return redirect()->route('CriterioDesempenio.index')->with('error','Imposible actualizar Criterio.');
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
        $destruido = CriterioDesempenio::destroy($id);
        if($destruido)
            return redirect()->route('CriterioDesempenio.index')->with('info','Criterio eliminado con éxito.');
        else
            return redirect()->route('CriterioDesempenio.index')->with('error','Imposible borrar Criterio.');
    }
}
