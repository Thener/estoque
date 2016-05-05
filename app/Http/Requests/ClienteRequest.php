<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ClienteRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        
    	return [
            'nome' => 'required|min:3|max:100'
        ];
    }

}
