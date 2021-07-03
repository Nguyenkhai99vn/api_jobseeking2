<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $table='recruitment';
    protected $primaryKey = 'ID_Recruitment';
    public $incrementing = false;
    protected $fillable=[
        'ID_Recruitment',
        'ID_Recruiter',
        'ID_Job',
        'ID_Style',
        'Title',
        'Descrip',
        'Interest',
        'Request',
        'SalaryMin',
        'SalaryMax',
        'Place'
    ];

    public function recruiter(){
        return $this->belongsTo(Recruiter::class,'ID_Recruiter');
    }
    public function job(){
        return $this->belongsTo(Job::class,'ID_Job');
    }
    public function style(){
        return $this->belongsTo(Style::class,'ID_Style');
    }
}
