<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ExternalUsers extends Model
{
    use HasFactory;

    //
    protected $fillable = [
        'user_id',
        'phone_2',
        'address',
        'dob',
    ];
 
    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'phone_2' => 'string',
            'address' => 'string',
            'user_id' => 'string',
        ];
    }
}
