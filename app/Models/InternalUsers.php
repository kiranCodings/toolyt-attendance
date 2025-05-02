<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InternalUsers extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'username',
        'email',
        'phone',
    ];
    protected $hidden = [
        'password',
    ];
    protected function casts(): array
    {
        return [
            'username' => 'string',
            'email' => 'string',
            'phone' => 'string',
            'password' => 'hashed',
        ];
    }
    //realtionship with attendance table
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'internal_user_id', 'id');
    }
}
