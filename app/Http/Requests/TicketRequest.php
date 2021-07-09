<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'package_id' => 'required',
            'match' => 'required_without:match_id',
            'match_id' => 'required_without:match',
            'match_start' => 'required_without:match_id',
            'created_at' => 'required',
            'tip' => 'required',
            'cost' => 'required',
        ];
    }
}
