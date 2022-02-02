<?php

namespace App\Http\Requests\Sources;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'min:5'],
            'description' => ['nullable', 'string', 'max:1000'],
            'active' => ['nullable', 'boolean'],
            'url'=>['required', 'url', 'max:500']
        ];
    }

    public function messages()
    {
        return [
            'url' => 'Поле :attribute должно содержать url адрес'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'название источника',
            'description'=>'описание источника',
            'url'=> 'ссылка на источник'
        ];
    }
}
