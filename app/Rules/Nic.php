<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class Nic implements Rule
{
    private $birthDate;
    private $gender;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($birthDate, $gender)
    {
        $this->birthDate = $birthDate;
        $this->gender = $gender;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $dateOfBirth = Carbon::create($this->birthDate);
        $yearOfBirthShort = $dateOfBirth->format("y");
        $yearOfBirthLong = $dateOfBirth->format("Y");
        $birthDayOfYear = $dateOfBirth->setYear(2020)->dayOfYear;
        $birthDayOfYear = $this->gender == 1 ?  $birthDayOfYear  : $birthDayOfYear + 500;
        return preg_match('/^' . $yearOfBirthShort . str_pad($birthDayOfYear, 3, 0, STR_PAD_LEFT) . '\d{4}[v|V|x|X]$/', $value) ||
            preg_match('/^' . $yearOfBirthLong . str_pad($birthDayOfYear, 3, 0, STR_PAD_LEFT) . '\d{5}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.nic');
    }
}
