<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Spatie\Permission\Traits\HasRoles;
use App\Models\Department;

class Employee extends Authenticatable
{
    use SoftDeletes, HasRoles, HasFactory; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_of_birth',
        'address',
        'hire_date',
        'contract_type',
        'salary',
        'status',
        'department_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getHireDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y'); 
    }

    public function getDateOfBirthAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y'); 
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value); 
    }
}
