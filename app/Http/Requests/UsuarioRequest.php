<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        
    	return [
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100'
        ];
    }

}
