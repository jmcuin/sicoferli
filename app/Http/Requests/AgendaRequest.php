<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                $rules = [
                ];

                foreach($this->request->get('evento') as $key => $val)
                {
                    $rules['evento.'.$key] = 'required|min:2';
                }
                foreach($this->request->get('descripcion') as $key => $val)
                {
                    $rules['descripcion.'.$key] = 'required|min:2';
                }
                foreach($this->request->get('fecha_evento') as $key => $val)
                {
                    $rules['fecha_evento.'.$key] = 'required|after:today';
                }
                
                return $rules;
        
                /*return [
                    'id_periodo' => 'required|not_in:0',
                    'id_idioma.*' => 'required|not_in:0',
                    'id_nivel.*' => 'required|not_in:0',
                    'grupo.*' => 'required|min:2',
                    'capacidad.*' => 'required|min:1',
                    'horario.*' => 'required|min:2',
                    'salon.*' => 'required|min:1',
                    'pago_semestral.*' => 'required|min:0',
                    'exhibiciones.*' => 'required|min:0',
                    'nivel_numerico.*' => 'required|min:1'
                ];*/

                
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'evento' => 'required|min:2',
                    'descripcion' => 'required|min:2',
                    'fecha_evento' => 'required|after:today'
                ];
            }
            default:break;
        }
    }
}
