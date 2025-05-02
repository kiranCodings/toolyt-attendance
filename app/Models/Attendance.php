<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendance';
    protected $fillable = [
        'internal_user_id',
        'external_user_id',
        'login_time',
        'logout_time',
    ];
    protected function casts(): array
    {
        return [
            'login_time' => 'datetime',
            'logout_time' => 'datetime',
        ];
    }
    //relationship with internal user
    public function internalUser()
    {
        return $this->belongsTo(InternalUsers::class, 'internal_user_id');
    }
    //relationship with external user
    public function externalUser()
    {
        return $this->belongsTo(ExternalUsers::class, 'external_user_id');
    }
}
