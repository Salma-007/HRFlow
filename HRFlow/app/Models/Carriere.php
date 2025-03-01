<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carriere extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grade_id',
        'formation_id',
        'contract_id',
        'post_id',
        'date_debut',
        'date_fin',
        'commentaire',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}