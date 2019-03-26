<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EstadoCivilRequest;
use App\EstadoCivil;

class EstadoCivilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this -> middleware(['auth', 'roles:dir_general']);
    }
    
    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $estados_civiles = EstadoCivil::where('estado_civil', 'like', '%'.$criterio.'%')
        ->orwhere('id_estado_civil', $criterio)
        ->sortable()
        ->orderBy('id_estado_civil')
        ->paginate(10);
        
        return view('EstadoCivil.index',compact('estados_civiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('EstadoCivil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoCivilRequest $request)
    {
        //
        $estado_civil = new EstadoCivil;
        $estado_civil -> estado_civil = $request -> estado_civil;
        $guardado = $estado_civil -> save();
        if($guardado)
            return redirect()->route('EstadoCivil.index')->with('info','Estado civil creado con éxito.');
        else
            return redirect()->route('EstadoCivil.index')->with('error','Imposible guardar Estado civil.');
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
        $estado_civil = EstadoCivil::findOrFail($id);
        return view('EstadoCivil.show', compact('estado_civil'));
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
        $estado_civil = EstadoCivil::findOrFail($id);
        return view('EstadoCivil.edit', compact('estado_civil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstadoCivilRequest $request, $id)
    {
        //
        $estado_civil = EstadoCivil::findOrFail($id);
        $estado_civil -> estado_civil = $request -> estado_civil;
        $guardado = $estado_civil -> save();
        if($guardado)
            return redirect()->route('EstadoCivil.index')->with('info','Estado civil actualizado con éxito.');
        else
            return redirect()->route('EstadoCivil.index')->with('error','Imposible actualizar Estado civil.');
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
        $destruido = EstadoCivil::destroy($id);
        if($destruido)
            return redirect()->route('EstadoCivil.index')->with('info','Estado civil eliminado con éxito.');
        else
            return redirect()->route('EstadoCivil.index')->with('error','Imposible borrar Estado civil.');
    }
}
