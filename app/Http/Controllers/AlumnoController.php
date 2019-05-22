<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AlumnoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Alumno;
use App\Municipio;
use App\Estado;
use App\Religion;
use App\Trabajador;
use App\Padecimiento;
use App\Parentesco;
use App\Periodo;
use App\Grupo;
use App\Escolaridad;
use App\Inscripcion;
use App\Materia;
use App\Padre_de_alumno;
use App\padres_x_alumno;
use App\Expediente_alumno;
use App\Setting;
use App\User;
use App\Rol;
use DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        //$this -> middleware('auth', ['except' => ['checkScores']]);
        //$this -> middleware('roles:administracion_sitio,direccion_general,profesor', ['except' => ['checkScores']]);
        //$this -> middleware(['auth', 'roles:administracion_sitio,direccion_general,direccion_nivel,profesor,administracion,asistencia_administrativa,alumno']);
    }

    public function index()
    {
        //
        $criterio = \Request::get('search'); //<-- we use global request to get the param of URI

        $estados = Estado::orderBy('id_estado') -> get();
        $municipios = Municipio::orderBy('id_estado_municipio') -> get();
        $religiones = Religion::orderBy('id_religion') -> get();
        
        $alumnos = Alumno::where('nombre', 'like', '%'.$criterio.'%')
        //->orwhere('id_alumno',$criterio)
        ->orwhere('a_paterno','like','%'.$criterio.'%')
        ->orwhere('a_materno','like','%'.$criterio.'%')
        ->orwhere('curp','like','%'.$criterio.'%')
        ->sortable()
        ->orderBy('id_alumno')
        ->orderBy('nombre')
        ->paginate(10);
        
        return view('Alumno.index', compact('alumnos', 'estados', 'municipios', 'religiones'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $trabajadoresactivos = Trabajador::orderBy('nombre') -> get();
        $estados = Estado::orderBy('id_estado') -> get();
        $municipios = Municipio::orderBy('id_estado_municipio') -> get();
        $religiones = Religion::orderBy('id_religion') -> get();
        
        return view('Alumno.create', compact('trabajadoresactivos','municipios', 'estados', 'religiones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request)
    {
        //
        $alumno = new Alumno;
        $alumno -> nombre = $request -> nombre;
        $alumno -> a_paterno = $request -> a_paterno;
        $alumno -> a_materno = $request -> a_materno;
        $alumno -> curp = strtoupper($request -> curp);
        $alumno -> id_estado_municipio = $request -> id_estado_municipio;
        $alumno -> extranjero = $request -> extranjero;
        $alumno -> calle = $request -> calle;
        $alumno -> numero_interior = $request -> numero_interior;
        $alumno -> numero_exterior = $request -> numero_exterior;
        $alumno -> colonia = $request -> colonia;
        $alumno -> cp = $request -> cp;
        $alumno -> telefono = $request -> telefono;
        $alumno -> email = $request -> email;
        $alumno -> id_religion = $request -> id_religion;
        $alumno -> tipo_sangre = $request -> tipo_sangre;
        if($request -> hasFile('foto')){
            $alumno -> foto = $request -> file('foto') -> storeAs('public/alumnos', strtoupper($request -> curp).'.'.$request -> file('foto') -> extension());
        }
        $guardado = $alumno -> save();

        if($request -> id_papa == 1){
            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = DB::table('alumnos')->max('id_alumno');
            $padres_x_alumnos -> id_trabajador = $request -> id_padre_trabajador;
            $padres_x_alumnos -> save();
        }else if($request -> id_papa == 2){
            $padredealumno = new Padre_de_alumno;
            $padredealumno -> nombre = $request -> nombre_padre;
            $padredealumno -> a_paterno = $request -> a_paterno_padre;
            $padredealumno -> a_materno = $request -> a_materno_padre;
            $padredealumno -> curp = strtoupper($request -> curp_padre);
            $padredealumno -> sexo = substr($request -> curp_padre, 10, 1);
            $padredealumno -> empleo = $request -> empleo_padre;
            $padredealumno -> puesto = $request -> puesto_padre;
            $padredealumno -> direccion = $request -> direccion_laboral_padre;
            $padredealumno -> tel_trabajo = $request -> telefono_laboral_padre;
            $padredealumno -> celular = $request -> celular_padre;
            $padredealumno -> nextel = $request -> nextel_padre;
            $padredealumno -> email = $request -> email_padre;
            $padredealumno -> save();

            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = DB::table('alumnos')->max('id_alumno');
            $padres_x_alumnos -> id_padres_alumno = DB::table('padres_de_alumnos')->max('id_padres_alumno');
            $padres_x_alumnos -> save();
        }

        if($request -> id_mama == 1){
            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = DB::table('alumnos')->max('id_alumno');
            $padres_x_alumnos -> id_trabajador = $request -> id_madre_trabajadora;
            $padres_x_alumnos -> save();
        }else if($request -> id_mama == 2){
            $madredealumno = new Padre_de_alumno;
            $madredealumno -> nombre = $request -> nombre_madre;
            $madredealumno -> a_paterno = $request -> a_paterno_madre;
            $madredealumno -> a_materno = $request -> a_materno_madre;
            $madredealumno -> curp = strtoupper($request -> curp_madre);
            $madredealumno -> sexo = substr($request -> curp_madre, 10, 1);
            $madredealumno -> empleo = $request -> empleo_madre;
            $madredealumno -> puesto = $request -> puesto_madre;
            $madredealumno -> direccion = $request -> direccion_laboral_madre;
            $madredealumno -> tel_trabajo = $request -> telefono_laboral_madre;
            $madredealumno -> celular = $request -> celular_madre;
            $madredealumno -> nextel = $request -> nextel_madre;
            $madredealumno -> email = $request -> email_madre;
            $madredealumno -> save();

            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = DB::table('alumnos')->max('id_alumno');
            $padres_x_alumnos -> id_padres_alumno = DB::table('padres_de_alumnos')->max('id_padres_alumno');
            $padres_x_alumnos -> save();
        }

            $padecimiento = new Padecimiento;
            $padecimiento -> id_alumno = DB::table('alumnos')->max('id_alumno');
            $padecimiento -> alergia = $request -> alergia;
            $padecimiento -> enfermedad = $request -> enfermedad;
            $padecimiento -> cirugia = $request -> cirugia;
            $padecimiento -> medicina = $request -> medicina;
            $padecimiento -> medico = $request -> medico;
            $padecimiento -> tel_medico = $request -> telefono_medico;
            $padecimiento -> ref1_nombre = $request -> nombre_referencia1;
            $padecimiento -> ref1_tel = $request -> telefono_referencia1;
            $padecimiento -> ref2_nombre = $request -> nombre_referencia2;
            $padecimiento -> ref2_tel = $request -> telefono_referencia2;
            $padecimiento -> save();

            $expediente = new Expediente_alumno;
            $expediente -> id_alumno = DB::table('alumnos')->max('id_alumno');
            $expediente -> acta_nacimiento = $request -> acta_nacimiento;
            $expediente -> obs_acta = $request -> obs_acta_nacimiento;
            $expediente -> curp = $request -> impresion_curp;
            $expediente -> obs_curp = $request -> obs_impresion_curp;
            $expediente -> cartilla_vacunacion = $request -> cartilla_vacunacion;
            $expediente -> obs_cartilla = $request -> obs_cartilla_vacunacion;
            $expediente -> certificado_medico = $request -> certificado_medico;
            $expediente -> obs_cert_medico = $request -> obs_cert_medico;
            $expediente -> constancia_estudios = $request -> constancia_estudios;
            $expediente -> obs_constancia = $request -> obs_constancia;
            $expediente -> curp_padre = $request -> curp_padre_alumno;
            $expediente -> obs_curp_padre = $request -> obs_curp_padre_alumno;
            $expediente -> curp_madre = $request -> curp_madre_alumno;
            $expediente -> obs_curp_madre = $request -> obs_curp_madre_alumno;
            $expediente -> ife_padre = $request -> ife_padre_alumno;
            $expediente -> obs_ife_padre = $request -> obs_ife_padre_alumno;
            $expediente -> ife_madre = $request -> ife_madre_alumno;
            $expediente -> obs_ife_madre = $request -> obs_ife_madre_alumno;
            $expediente -> comp_domicilio = $request -> comprobante_domicilio;
            $expediente -> obs_comp_domicilio = $request -> obs_comprobante_domicilio;
            $expediente -> boleta_anterior = $request -> boleta_inmediata_anterior;
            $expediente -> obs_boleta_anterior = $request -> obs_boleta_inmediata_anterior;
            $expediente -> carta_conducta = $request -> carta_buena_conducta;
            $expediente -> obs_carta_conducta = $request -> obs_carta_buena_conducta;
            $expediente -> cert_primaria = $request -> certificado_primaria;
            $expediente -> obs_cert_primaria = $request -> obs_certificado_primaria;
            $expediente -> boletas_anteriores = $request -> boletas_anteriores;
            $expediente -> obs_boletas_anteriores = $request -> obs_boletas_anteriores;
            $expediente -> save();

            $this -> addUser($request);

        if($guardado)
            return redirect()->route('Alumno.index')->with('info','Alumno creado con éxito.');
        else
            return redirect()->route('Alumno.index')->with('error','Imposible guardar Alumno.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $padres = array();
        $padres_trabajadores = array();
        $alumno = Alumno::findOrFail($id);

        $padres_x_alumno = padres_x_alumno::where('id_alumno', '=' ,$id) -> get();   
        if($padres_x_alumno != null){
            foreach ($padres_x_alumno as $padre_x_alumno)
            {
                if($padre_x_alumno -> id_padres_alumno != null){
                    $padre = Padre_de_alumno::where('id_padres_alumno', '=', $padre_x_alumno -> id_padres_alumno) -> first();
                    array_push($padres, $padre);
                }else{
                    $padre_trabajador = Trabajador::where('id_trabajador', '=', $padre_x_alumno -> id_trabajador) -> first();
                    array_push($padres_trabajadores, $padre_trabajador);
                }
            }
        }    

        $padecimiento = Padecimiento::where('id_alumno', '=' ,$alumno -> id_alumno) -> first(); 
        $expediente = Expediente_alumno::where('id_alumno', '=', $alumno -> id_alumno) -> first();

        $historiales = DB::select(DB::raw("select historial_alumno.id_historial_alumno, cat_grupos.grupo, historial_alumno.narrativa
FROM historial_alumno
INNER JOIN cat_grupos
ON cat_grupos.id_grupo=historial_alumno.id_grupo
AND historial_alumno.id_alumno=:id_alumno"), 
                                        array('id_alumno' => $id));

        return view('Alumno.show', compact('alumno', 'padres', 'padres_trabajadores', 'padecimiento', 'expediente', 'historiales'));
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
        $papa_trabajador = 0;
        $mama_trabajadora = 0;
        $papa_externo = array();
        $mama_externa = array();

        $trabajadores = Trabajador::orderBy('nombre') -> get();
        $estados = Estado::orderBy('id_estado') -> get();
        $municipios = Municipio::orderBy('id_estado_municipio') -> get();
        $religiones = Religion::orderBy('id_religion') -> get();
        $alumno = Alumno::findOrFail($id);

        $padres_x_alumno = padres_x_alumno::where('id_alumno', '=' ,$id) -> get();  
        if($padres_x_alumno != null){
            foreach ($padres_x_alumno as $padre_x_alumno)
            {
                if($padre_x_alumno -> id_padres_alumno != null){
                    $padre = Padre_de_alumno::where('id_padres_alumno', '=', $padre_x_alumno -> id_padres_alumno) -> first();
                    if($padre -> sexo == 'H')
                        array_push($papa_externo, $padre);
                    if($padre -> sexo == 'M')
                        array_push($mama_externa, $padre);
                }else if($padre_x_alumno -> id_padres_alumno == null){
                    $padre = Trabajador::findOrFail($padre_x_alumno -> id_trabajador);
                    if(substr($padre -> curp, 10, 1) == 'H')
                        $papa_trabajador = $padre_x_alumno -> id_trabajador;
                    if(substr($padre -> curp, 10, 1) == 'M')
                        $mama_trabajadora = $padre_x_alumno -> id_trabajador;
                }
            }
        }       

        $padecimiento = Padecimiento::where('id_alumno', '=' ,$alumno -> id_alumno) -> first(); 
        $expediente = Expediente_alumno::where('id_alumno', '=', $alumno -> id_alumno) -> first();

        return view('Alumno.edit', compact('alumno', 'trabajadores', 'estados', 'municipios', 'religiones', 'papa_externo', 'mama_externa', 'papa_trabajador', 'mama_trabajadora', 'padecimiento', 'expediente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoRequest $request, $id)
    {
        dd($request);
        $alumno = Alumno::findOrFail($id);
        $alumno -> nombre = $request -> nombre;
        $alumno -> a_paterno = $request -> a_paterno;
        $alumno -> a_materno = $request -> a_materno;
        $alumno -> curp = $request -> curp;
        $alumno -> id_estado_municipio = $request -> id_estado_municipio;
        $alumno -> extranjero = $request -> extranjero;
        $alumno -> calle = $request -> calle;
        $alumno -> numero_interior = $request -> numero_interior;
        $alumno -> numero_exterior = $request -> numero_exterior;
        $alumno -> colonia = $request -> colonia;
        $alumno -> cp = $request -> cp;
        $alumno -> telefono = $request -> telefono;
        $alumno -> email = $request -> email;
        $alumno -> id_religion = $request -> id_religion;
        $alumno -> tipo_sangre = $request -> tipo_sangre;
        if($request -> hasFile('foto')){
            Storage::delete($alumno -> foto);
            $alumno -> foto = $request -> file('foto') -> storeAs('public/alumnos', strtoupper($request -> curp).'.'.$request -> file('foto') -> extension());
        }
        $guardado = $alumno -> save();

        $this -> deleteParents($id);

        if($request -> id_papa == 1){//papas trabajadores
            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = $id;
            $padres_x_alumnos -> id_trabajador = $request -> id_padre_trabajador;
            $padres_x_alumnos -> save();
        }else if($request -> id_papa == 2){//papas externos
            $padredealumno = new Padre_de_alumno;
            $padredealumno -> nombre = $request -> nombre_padre;
            $padredealumno -> a_paterno = $request -> a_paterno_padre;
            $padredealumno -> a_materno = $request -> a_materno_padre;
            $padredealumno -> curp = $request -> curp_padre;
            $padredealumno -> sexo = substr($request -> curp_padre, 10, 1);
            $padredealumno -> empleo = $request -> empleo_padre;
            $padredealumno -> puesto = $request -> puesto_padre;
            $padredealumno -> direccion = $request -> direccion_laboral_padre;
            $padredealumno -> tel_trabajo = $request -> telefono_laboral_padre;
            $padredealumno -> celular = $request -> celular_padre;
            $padredealumno -> nextel = $request -> nextel_padre;
            $padredealumno -> email = $request -> email_padre;
            $padredealumno -> save();

            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = $id;
            $padres_x_alumnos -> id_padres_alumno = DB::table('padres_de_alumnos') -> max('id_padres_alumno');
            $padres_x_alumnos -> save();
        }

        if($request -> id_mama == 1){//papas trabajadores
            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = $id;
            $padres_x_alumnos -> id_trabajador = $request -> id_madre_trabajadora;
            $padres_x_alumnos -> save();
        }else if($request -> id_mama == 2){//papas externos
            $madredealumno = new Padre_de_alumno;
            $madredealumno -> nombre = $request -> nombre_madre;
            $madredealumno -> a_paterno = $request -> a_paterno_madre;
            $madredealumno -> a_materno = $request -> a_materno_madre;
            $madredealumno -> curp = $request -> curp_madre;
            $madredealumno -> sexo = substr($request -> curp_madre, 10, 1);
            $madredealumno -> empleo = $request -> empleo_madre;
            $madredealumno -> puesto = $request -> puesto_madre;
            $madredealumno -> direccion = $request -> direccion_laboral_madre;
            $madredealumno -> tel_trabajo = $request -> telefono_laboral_madre;
            $madredealumno -> celular = $request -> celular_madre;
            $madredealumno -> nextel = $request -> nextel_madre;
            $madredealumno -> email = $request -> email_madre;
            $madredealumno -> save();

            $padres_x_alumnos = new padres_x_alumno;
            $padres_x_alumnos -> id_alumno = $id;
            $padres_x_alumnos -> id_padres_alumno = DB::table('padres_de_alumnos') -> max('id_padres_alumno');
            $padres_x_alumnos -> save();
        }

        $padecimiento = Padecimiento::where('id_alumno', '=', $id) -> first();
        $padecimiento -> alergia = $request -> alergia;
        $padecimiento -> enfermedad = $request -> enfermedad;
        $padecimiento -> cirugia = $request -> cirugia;
        $padecimiento -> medicina = $request -> medicina;
        $padecimiento -> medico = $request -> medico;
        $padecimiento -> tel_medico = $request -> telefono_medico;
        $padecimiento -> ref1_nombre = $request -> nombre_referencia1;
        $padecimiento -> ref1_tel = $request -> telefono_referencia1;
        $padecimiento -> ref1_nombre = $request -> nombre_referencia1;
        $padecimiento -> ref1_tel = $request -> telefono_referencia1;
        $padecimiento -> save();

        $expediente = Expediente_alumno::where('id_alumno', '=', $id) -> first();
        $expediente -> acta_nacimiento = $request -> acta_nacimiento;
        $expediente -> obs_acta = $request -> obs_acta_nacimiento;
        $expediente -> curp = $request -> impresion_curp;
        $expediente -> obs_curp = $request -> obs_impresion_curp;
        $expediente -> cartilla_vacunacion = $request -> cartilla_vacunacion;
        $expediente -> obs_cartilla = $request -> obs_cartilla_vacunacion;
        $expediente -> certificado_medico = $request -> certificado_medico;
        $expediente -> obs_cert_medico = $request -> obs_cert_medico;
        $expediente -> constancia_estudios = $request -> constancia_estudios;
        $expediente -> obs_constancia = $request -> obs_constancia;
        $expediente -> curp_padre = $request -> curp_padre_alumno;
        $expediente -> obs_curp_padre = $request -> obs_curp_padre_alumno;
        $expediente -> curp_madre = $request -> curp_madre_alumno;
        $expediente -> obs_curp_madre = $request -> obs_curp_madre_alumno;
        $expediente -> ife_padre = $request -> ife_padre_alumno;
        $expediente -> obs_ife_padre = $request -> obs_ife_padre_alumno;
        $expediente -> ife_madre = $request -> ife_madre_alumno;
        $expediente -> obs_ife_madre = $request -> obs_ife_madre_alumno;
        $expediente -> comp_domicilio = $request -> comprobante_domicilio;
        $expediente -> obs_comp_domicilio = $request -> obs_comprobante_domicilio;
        $expediente -> boleta_anterior = $request -> boleta_inmediata_anterior;
        $expediente -> obs_boleta_anterior = $request -> obs_boleta_inmediata_anterior;
        $expediente -> carta_conducta = $request -> carta_buena_conducta;
        $expediente -> obs_carta_conducta = $request -> obs_carta_buena_conducta;
        $expediente -> cert_primaria = $request -> certificado_primaria;
        $expediente -> obs_cert_primaria = $request -> obs_certificado_primaria;
        $expediente -> boletas_anteriores = $request -> boletas_anteriores;
        $expediente -> obs_boletas_anteriores = $request -> obs_boletas_anteriores;
        $expediente -> save();

        $this -> UpdateUser($id);

        if($guardado)
            return redirect()->route('Alumno.index')->with('info','Alumno actualizado con éxito.');
        else
            return redirect()->route('Alumno.index')->with('error','Imposible guardar Alumno.');
    }

    public function deleteParents($id){
        $padres_temporales = padres_x_alumno::where('id_alumno', '=', $id)->get();
        if($padres_temporales != null){
            foreach ($padres_temporales as $padre_temporal) {
                padres_x_alumno::destroy($padre_temporal -> id);
                if($padre_temporal -> id_padres_alumno != null){
                    Padre_de_alumno::destroy($padre_temporal -> id_padres_alumno);
                }
            }
        }
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
        $destruido = null;

        $alumno = Alumno::findOrFail($id);
        $alumno -> expediente() -> delete();
        $alumno -> padecimiento() -> delete();
        $alumno -> inscripciones() -> delete();
        Storage::delete($alumno -> foto);
        $padres_x_alumnos = padres_x_alumno::where('id_alumno', '=' ,$id)->get();
        
        if($padres_x_alumnos != null){
            foreach ($padres_x_alumnos as $padre_x_alumno){
                if($padre_x_alumno -> id_padres_alumno != null){
                    Padre_de_alumno::destroy($padre_x_alumno -> id_padres_alumno);
                }
                padres_x_alumno::destroy($padre_x_alumno -> id);
            }
        }

        $destruido = Alumno::destroy($id);
        if($destruido)
            return redirect()->route('Alumno.index')->with('info','Alumno eliminado con éxito.');
        else
            return redirect()->route('Alumno.index')->with('error','Imposible borrar Alumno.');
    }

    public function register($id)
    {
        $ya_inscrito = false;
        $periodo_actual = Setting::all()->pluck('id_periodo');
        $periodo = Periodo::findOrFail($periodo_actual);
        $escolaridades = Escolaridad::orderBy('escolaridad') -> get();
        $grupos = Grupo::where('id_periodo', '=', $periodo_actual) -> get();
        $alumno = Alumno::findOrFail($id);

        $periodo_inscrito = DB::table('inscripciones')
            ->join('cat_grupos', 'inscripciones.id_grupo', '=', 'cat_grupos.id_grupo')
            ->where('inscripciones.id_alumno', '=', $id)
            ->select('cat_grupos.id_periodo', 'cat_grupos.id_grupo', 'cat_grupos.grupo') 
            ->distinct()
            ->get();

        $ultimo_periodo = count($periodo_inscrito);
       
        if($ultimo_periodo != 0){
            for($i = 0; $i < $ultimo_periodo; $i++){
                if($periodo_inscrito[$i] -> id_periodo == $periodo_actual[0]){
                    $ya_inscrito = true;
                    break;
                }else{
                    $ya_inscrito = false;
                }
            }
        }else{
           $ya_inscrito = false; 
        }

        return view('Alumno.register', compact('alumno', 'periodo', 'periodo_inscrito', 'escolaridades', 'grupos', 'ya_inscrito'));         
    }

    public function registerAlumno(Request $request)
    {
                
        $inscripciones = array();
        if($request -> ya_inscrito == true){
            $periodo_actual = Setting::all()->pluck('id_periodo');
            $inscripciones = DB::table('inscripciones')
            ->join('cat_grupos', 'inscripciones.id_grupo', '=', 'cat_grupos.id_grupo')
            ->join('alumnos', 'alumnos.id_alumno', '=', 'inscripciones.id_alumno')
            ->where('inscripciones.id_alumno', '=', $request->id_alumno)
            ->where('cat_grupos.id_periodo', '=', $periodo_actual[0])
            ->select('inscripciones.id_inscripcion')
            ->get();
            
            for($i = 0; $i < count($inscripciones); $i++){
                Inscripcion::destroy($inscripciones[$i] -> id_inscripcion);    
            }
            return redirect()->route('Alumno.index')->with('info','Alumno dado de baja con éxito.');
        }else{
            $this->validate($request, [
                'id_escolaridad' => 'required|not_in:0',
                'id_grupo' => 'required|not_in:0',
            ]);
            
            $bimestre_o_trimestre = 0;
            $grupo = Grupo::findOrFail($request -> id_grupo);
            $materias = $grupo -> materias() -> get();
            
            if(substr( $grupo -> escolaridad -> escolaridad , 0, 4 ) === "Pree")
                $bimestre_o_trimestre = 4;
            else
                $bimestre_o_trimestre = 6;

            if(count($materias)==0)
                return redirect()->route('Alumno.index')->with('error','Imposible inscribir Alumno ya que el grupo que eligió no tiene materias asociadas.');
            $i = 0;
            foreach ($materias as $materia) {
                for($j = 1; $j < $bimestre_o_trimestre ; $j++){
                    $inscripcion = new Inscripcion;
                    $inscripcion -> id_grupo = $request -> id_grupo;
                    $inscripcion -> id_materia = $materia -> id_materia;
                    $inscripcion -> id_alumno = $request -> id_alumno;
                    $inscripcion -> id_criterio_desempenio = 1;
                    $inscripcion -> bimestre_trimestre = $j;
                    $inscripcion -> mes = 1;
                    $inscripcion -> save();
                    $inscripcion = new Inscripcion;
                    $inscripcion -> id_grupo = $request -> id_grupo;
                    $inscripcion -> id_materia = $materia -> id_materia;
                    $inscripcion -> id_alumno = $request -> id_alumno;
                    $inscripcion -> id_criterio_desempenio = 1;
                    $inscripcion -> bimestre_trimestre = $j;
                    $inscripcion -> mes = 2;
                    $inscripcion -> save();
                }
                $i ++;
            }
            
            if(count($materias) == $i)
                return redirect()->route('Alumno.index')->with('info','Alumno inscrito con éxito.');
            else
                return redirect()->route('Alumno.index')->with('error','Imposible inscribir Alumno.');
        }   
    }

    public function addUser(Request $request){
        $user = new User;
        $alumno = Alumno::find(DB::table('alumnos')->max('id_alumno'));
        $user -> id_alumno = $alumno -> id_alumno;
        $user -> matricula = 'FELI'.$alumno -> id_alumno;
        $user -> email = $request -> email;
        $user -> password = bcrypt(substr($request -> curp, 0, 6));
        $user -> save();
        $user -> roles() -> attach(Rol::where('rol_key', 'like', 'alumno%')->select('id_rol')->first());
    }

    public function updateUser($id){
        $user = User::where('id_alumno', $id) -> first();
        $alumno = Alumno::findOrFail($id);
        $user -> email = $alumno -> email;
        $user -> save();
    }

    public function checkScores(){
        $grupo = null;
        $escolaridad = null;
        $periodo = null;
        $boletas = DB::select(DB::raw("select id_alumno, nombre, a_paterno, a_materno, curp, id_grupo, grupo, id_periodo, periodo, id_materia, materia, promediobt1, numero_inasistencias1, promediobt2, numero_inasistencias2, promediobt3, numero_inasistencias3, promediobt4, numero_inasistencias4, promediobt5, numero_inasistencias5
from
(select alumnos.nombre as nombre, alumnos.a_paterno as a_paterno, alumnos.a_materno as a_materno, alumnos.curp as curp, inscripciones.id_grupo as id_grupo, cat_grupos.grupo as grupo, cat_periodos.id_periodo as id_periodo, cat_periodos.periodo as periodo, inscripciones.id_materia as id_materia, cat_materias.materia as materia, inscripciones.id_alumno as id_alumno, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt1, SUM(inscripciones.numero_inasistencias) as numero_inasistencias1
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.id_alumno = :id_alumno and inscripciones.bimestre_trimestre = 1
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b1
inner join 
(select alumnos.curp as curp2, inscripciones.id_grupo as id_grupo2, inscripciones.id_materia as id_materia2, inscripciones.id_alumno as id_alumno2, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt2, SUM(inscripciones.numero_inasistencias) as numero_inasistencias2
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 2
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b2
on b1.id_grupo = b2.id_grupo2 and b1.id_materia = b2.id_materia2 and b1.id_alumno = b2.id_alumno2
inner join 
(select alumnos.curp as curp3, inscripciones.id_grupo as id_grupo3, inscripciones.id_materia as id_materia3, inscripciones.id_alumno as id_alumno3, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt3, SUM(inscripciones.numero_inasistencias) as numero_inasistencias3
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 3
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b3
on b1.id_grupo = b3.id_grupo3 and b1.id_materia = b3.id_materia3 and b1.id_alumno = b3.id_alumno3
inner join 
(select alumnos.curp as curp4, inscripciones.id_grupo as id_grupo4, inscripciones.id_materia as id_materia4, inscripciones.id_alumno as id_alumno4, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt4, SUM(inscripciones.numero_inasistencias) as numero_inasistencias4
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 4
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b4
on b1.id_grupo = b4.id_grupo4 and b1.id_materia = b4.id_materia4 and b1.id_alumno = b4.id_alumno4
inner join 
(select alumnos.curp as curp5, inscripciones.id_grupo as id_grupo5, inscripciones.id_materia as id_materia5, inscripciones.id_alumno as id_alumno5, AVG((inscripciones.examen*0.4)+(inscripciones.tareas*0.2)+(inscripciones.trabajos*0.2)+(inscripciones.asistencias*0.2)+(inscripciones.puntos_extra)) as promediobt5, SUM(inscripciones.numero_inasistencias) as numero_inasistencias5
from inscripciones
inner join materia_x_grupos
on materia_x_grupos.id_grupo = inscripciones.id_grupo
and materia_x_grupos.id_materia = inscripciones.id_materia
inner join cat_materias
on cat_materias.id_materia = inscripciones.id_materia
inner join cat_grupos
on cat_grupos.id_grupo = inscripciones.id_grupo
inner join cat_periodos
on cat_periodos.id_periodo = cat_grupos.id_periodo
inner join alumnos
on inscripciones.id_alumno = alumnos.id_alumno
where inscripciones.bimestre_trimestre = 5
group by inscripciones.id_alumno, inscripciones.id_grupo, inscripciones.id_materia, cat_grupos.grupo, cat_periodos.id_periodo, cat_periodos.periodo, cat_periodos.id_periodo, cat_periodos.periodo, cat_materias.materia, alumnos.nombre, alumnos.a_paterno, alumnos.a_materno, alumnos.curp, inscripciones.bimestre_trimestre) as b5
on b1.id_grupo = b5.id_grupo5 and b1.id_materia = b5.id_materia5 and b1.id_alumno = b5.id_alumno5"), 
                                        array('id_alumno' => Auth::user()-> id_alumno));
        $alumno = Auth::user()-> id_alumno;
        if( !empty($boletas) ){
            $grupo = Grupo::findOrFail($boletas[0]->id_grupo);
            $escolaridad = $grupo -> escolaridad -> escolaridad;
            $periodo = $grupo -> periodo -> periodo;
        }
        return view('Alumno.calificaciones', compact('boletas', 'grupo', 'escolaridad', 'periodo', 'alumno'));
    }
}
