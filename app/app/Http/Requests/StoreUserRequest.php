<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'name'     => [
                'required',
            ],
            'email'    => [
                'required',
            ],
            'password' => [
                'required',
            ]
        ];
    }
}
