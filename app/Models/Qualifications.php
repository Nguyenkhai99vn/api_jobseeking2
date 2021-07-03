<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualifications extends Model
{
    protected $table='qualifications';
    protected $primaryKey = 'ID_Qualifications';
    public $incrementing = false;
    protected $fillable=[
        'ID_Qualifications',
        'QName'
    ];
    public function applicant(){
        return $this->hasMany(Applicants::class);
    }
}
