<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // Ajout de la relation avec l'entité Employee
    // public function employees()
    // {
    //     return $this->hasMany(Employee::class);
    // }
}
