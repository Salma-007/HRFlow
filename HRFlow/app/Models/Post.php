<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'departments_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departments_id');
    }
}
