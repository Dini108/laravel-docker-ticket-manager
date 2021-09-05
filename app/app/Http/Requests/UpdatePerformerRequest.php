<?php

namespace App\Http\Requests;

use App\Performer;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePerformerRequest extends FormRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'name'       => [
                'required',
            ],
        ];
    }
}
