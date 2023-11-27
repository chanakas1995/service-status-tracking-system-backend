<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => ["required"],
            "reg_number" => ["required"],
            "chassis_no" => ["required"],
            "engine_no" => ["required"],
            "bus_model_id" => ["required"],
            "seat_count" => ['required', 'numeric', 'min:0', 'max:200'],
        ];
    }
}