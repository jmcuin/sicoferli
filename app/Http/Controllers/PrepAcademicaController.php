<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PrepAcademicaRequest;
use App\PrepAcademica;

class PrepAcademicaController extends Controller
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
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $prepacademicas = PrepAcademica::where('grado_academico', 'like', '%'.$criterio.'%')
        //->orwhere('id_prep_academica', $criterio)
        ->sortable()
        ->orderBy('id_prep_academica')
        ->paginate(10);
        
        return view('PrepAcademica.index',compact('prepacademicas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('PrepAcademica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrepAcademicaRequest $request)
    {
        //
        $prepacademica = new PrepAcademica;
        $prepacademica -> grado_academico = $request -> grado_academico;
        $guardado = $prepacademica -> save();
        if($guardado)
            return redirect()->route('PrepAcademica.index')->with('info','Grado Académico creado con éxito.');
        else
            return redirect()->route('PrepAcademica.index')->with('error','Imposible guardar Grado Académico.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrepAcademica  $prepAcademica
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $prepacademica = PrepAcademica::findOrFail($id);
        return view('PrepAcademica.show', compact('prepacademica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrepAcademica  $prepAcademica
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $prepacademica = PrepAcademica::findOrFail($id);
        return view('PrepAcademica.edit', compact('prepacademica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrepAcademica  $prepAcademica
     * @return \Illuminate\Http\Response
     */
    public function update(PrepAcademicaRequest $request, $id)
    {
        //
        $prepacademica = PrepAcademica::findOrFail($id);
        $prepacademica -> grado_academico = $request -> grado_academico;
        $guardado = $prepacademica -> save();
        if($guardado)
            return redirect()->route('PrepAcademica.index')->with('info','Grado Académico actualizado con éxito.');
        else
            return redirect()->route('PrepAcademica.index')->with('error','Imposible actualizar Grado Académico.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrepAcademica  $prepAcademica
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $destruido = PrepAcademica::destroy($id);
        if($destruido)
            return redirect()->route('PrepAcademica.index')->with('info','Grado Académico eliminado con éxito.');
        else
            return redirect()->route('PrepAcademica.index')->with('error','Imposible borrar Grado Académico.');
    }
}
