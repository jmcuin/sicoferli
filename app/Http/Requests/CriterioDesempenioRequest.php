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
                    'criterio' => 'unique:cat_criterios_desempenio|required|min:2'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'criterio' => 'required|min:2|unique:cat_criterios_desempenio,criterio,'.$this->route('CriterioDesempenio').',id_criterio_desempenio'
                ];
            }
            default:break;
        }
    }
}
