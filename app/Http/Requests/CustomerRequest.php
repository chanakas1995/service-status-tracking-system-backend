<?php

namespace App\Http\Requests;

use App\Rules\Nic;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'title' => ["nullable"],
            'username' => ["nullable", Rule::unique('users')->ignore($this->route('customer') ? $this->route('customer')->user : null, 'id')->withoutTrashed()],
            'email' => ["nullable"],
            'first_name' => ["required"],
            'last_name' => ["nullable"],
            'address' => ["nullable"],
            'date_of_birth' => ["nullable", "date", "before:today"],
            'gender' => ["nullable"],
            'nic' => ["nullable", new Nic($this->date_of_birth, $this->gender)],
            'mobile' => ["nullable", new PhoneNumber],
            'home' => ["nullable", new PhoneNumber],
            'gs_office_id' => ["nullable"],
            'image_file' => ['nullable']
        ];
    }
}
