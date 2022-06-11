<?php

namespace App\Http\Requests;

use App\Rules\Nic;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
            'title' => ["required"],
            'username' => ["required", Rule::unique('users')->ignore($this->route('employee') ? $this->route('employee')->user : null, 'id')->withoutTrashed()],
            'email' => ["required"],
            'first_name' => ["required"],
            'last_name' => ["required"],
            'address' => ["required"],
            'code' => ["required"],
            'date_of_birth' => ["required","date","before:today"],
            'gender' => ["required"],
            'nic' => ["required", new Nic($this->date_of_birth, $this->gender)],
            'mobile' => ["required", new PhoneNumber],
            'work' => ["required", new PhoneNumber],
            'home' => ["nullable", new PhoneNumber],
            'employee_type_id' => ["required"],
            'image_file' => ['nullable']
        ];
    }
}
