<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ParentescoRequest;
use App\Parentesco;

class ParentescoController extends Controller
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

        $parentescos = Parentesco::where('parentesco', 'like', '%'.$criterio.'%')
        ->orwhere('id_parentesco', $criterio)
        ->sortable()
        ->orderBy('id_parentesco')
        ->paginate(10);
        
        return view('Parentesco.index',compact('parentescos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Parentesco.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParentescoRequest $request)
    {
        //
        $parentesco = new Parentesco;
        $parentesco -> parentesco = $request -> parentesco;
        $guardado = $parentesco -> save();
        if($guardado)
            return redirect()->route('Parentesco.index')->with('info','Parentesco creado con éxito.');
        else
            return redirect()->route('Parentesco.index')->with('error','Imposible guardar Parentesco.');
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
        $parentesco = Parentesco::findOrFail($id);
        return view('Parentesco.show', compact('parentesco'));
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
        $parentesco = Parentesco::findOrFail($id);
        return view('Parentesco.edit', compact('parentesco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParentescoRequest $request, $id)
    {
        //
        $parentesco = Parentesco::findOrFail($id);
        $parentesco -> parentesco = $request -> parentesco;
        $guardado = $parentesco -> save();
        if($guardado)
            return redirect()->route('Parentesco.index')->with('info','Parentesco actualizado con éxito.');
        else
            return redirect()->route('Parentesco.index')->with('error','Imposible actualizar Parentesco.');
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
        $destruido = Parentesco::destroy($id);
        if($destruido)
            return redirect()->route('Parentesco.index')->with('info','Parentesco eliminado con éxito.');
        else
            return redirect()->route('Parentesco.index')->with('error','Imposible borrar Parentesco.');
    }
}
