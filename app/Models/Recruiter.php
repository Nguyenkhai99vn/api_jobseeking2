<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruiter extends Model
{
    protected $table='recruiter';
    protected $primaryKey = 'ID_Recruiter';
    public $incrementing = false;

    protected $fillable=[
        'ID_Recruiter',
        'RName',
        'Email',
        'PhoneNumber',
        'Locat',
        'Assess',
        'Avatar',
        'Cover'
    ];
}
