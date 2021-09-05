<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MassBuyTicketRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:events,id',
        ];
    }
}
