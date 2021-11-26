<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return[
            'nome'=>[
                'required',
            ],
            'genero' =>[
                'required',
            ],
            'desenvolvedor'=>[
                'required',
            ],
            'distribuidor'=>[
                'required',
            ],
            'metacritic'=>[
                'required',
            ],
        ];
    }

}