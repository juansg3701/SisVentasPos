<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class CargoFormRequest extends Request
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
            //'id_sede'=>'required|max:45',
            'nombre'=>'required|max:45',
            'descripcion'=>'required|max:45',
            'horaordinaria'=>'|max:45',
            'horadominical'=>'|max:45',
            'horaextra'=>'|max:45',
            'fecha'=>'|max:45',
        ];
    }
}
