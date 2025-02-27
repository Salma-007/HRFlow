<?php

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'grade_id',
        'contract_id',
        'department_id',
        'post_id',
        'role_id',
        'salary',
        'birthdate',
        'address',
        'hire_date',
        'phone',
        'status',
    ];

    // Relation avec Grade
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // Relation avec Contract
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    // Relation avec Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relation avec Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Relation avec Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
