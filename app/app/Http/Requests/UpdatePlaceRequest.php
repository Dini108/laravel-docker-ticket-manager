<?php

namespace App\Http\Requests;

use App\Place;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePlaceRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
        ];
    }
}
