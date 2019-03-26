<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodoRequest extends FormRequest
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
                    'periodo' => 'unique:cat_periodos|required|min:2',
                    'inicio' => 'required',
                    'termino' => 'required|after:inicio'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'periodo' => 'required|min:2',
                    'inicio' => 'required',
                    'termino' => 'required|after:inicio'
                ];
            }
            default:break;
        }
    }
}
