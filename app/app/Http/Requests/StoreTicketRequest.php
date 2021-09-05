<?php

namespace App\Http\Requests;

use App\Performer;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTicketRequest extends FormRequest
{
    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
            ],
        ];
    }
}
