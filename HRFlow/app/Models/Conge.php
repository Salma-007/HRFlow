<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conge extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
        'status',
        'manager_approval',
        'rh_approval',
        'type_conge',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
