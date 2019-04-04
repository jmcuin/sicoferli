<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriterioDesempenioRequest extends FormRequest
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
                return [
                    'criterio' => 'unique:cat_criterios_desempenio|required|min:2',
                    'porcentaje_examen' => 'required|between:0,100|numeric',
                    'porcentaje_tareas' => 'required|between:0,100|numeric',
                    'porcentaje_tomas_clase' => 'required|between:0,100|numeric',
                    'porcentaje_participacion' => 'required|between:0,100|numeric'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'criterio' => 'required|min:2|unique:cat_criterios_desempenio,criterio,'.$this->route('CriterioDesempenio').',id_criterio_desempenio',
                    'porcentaje_examen' => 'required|between:0,100|numeric',
                    'porcentaje_tareas' => 'required|between:0,100|numeric',
                    'porcentaje_tomas_clase' => 'required|between:0,100|numeric',
                    'porcentaje_participacion' => 'required|between:0,100|numeric'
                ];
            }
            default:break;
        }
    }
}
