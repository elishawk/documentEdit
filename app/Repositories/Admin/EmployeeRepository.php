<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Employee;
use App\Repositories\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'first_name',
        'middle_name',
        'surname',
        'email',
        'phone_number',
        'birthdate'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Employee::class;
    }
}
