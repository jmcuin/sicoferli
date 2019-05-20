<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReligionRequest;
use App\Religion;

class ReligionController extends Controller
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

        $religiones = Religion::where('religion', 'like', '%'.$criterio.'%')
        ->orwhere('id_religion', $criterio)
        ->sortable()
        ->orderBy('id_religion')
        ->paginate(10);
        
        return view('Religion.index',compact('religiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Religion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReligionRequest $request)
    {
        //
        $religion = new Religion;
        $religion -> religion = $request -> religion;
        $guardado = $religion -> save();
        if($guardado)
            return redirect()->route('Religion.index')->with('info','Religión creada con éxito.');
        else
            return redirect()->route('Religion.index')->with('error','Imposible guardar Religión.');
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
        $religion = Religion::findOrFail($id);
        return view('Religion.show', compact('religion'));
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
        $religion = Religion::findOrFail($id);
        return view('Religion.edit', compact('religion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReligionRequest $request, $id)
    {
        //
        $religion = Religion::findOrFail($id);
        $religion -> religion = $request -> religion;
        $guardado = $religion -> save();
        if($guardado)
            return redirect()->route('Religion.index')->with('info','Religión actualizada con éxito.');
        else
            return redirect()->route('Religion.index')->with('error','Imposible actualizar Religión.');
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
        $destruido = Religion::destroy($id);
        if($destruido)
            return redirect()->route('Religion.index')->with('info','Religión eliminada con éxito.');
        else
            return redirect()->route('Religion.index')->with('error','Imposible borrar Religión.');
    }
}
