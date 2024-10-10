<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'employees';

    public $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'email',
        'phone_number',
        'birthdate'
    ];

    protected $casts = [
        'first_name' => 'string',
        'middle_name' => 'string',
        'surname' => 'string',
        'email' => 'string',
        'phone_number' => 'string',
        'birthdate' => 'date'
    ];

    public static array $rules = [
        'first_name' => 'required',
        'middle_name' => 'required',
        'surname' => 'required',
        'email' => 'required'
    ];

    
}
