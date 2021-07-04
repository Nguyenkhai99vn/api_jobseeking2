<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table='account';
    protected $primaryKey = 'Email';

    public $incrementing = false;
    protected $fillable=['Email','Pass','Sta'];

    public function Applicants(){
        return $this->belongsTo(Applicants::class,'Email');
    }
    public function Recruiter(){
        return $this->belongsTo(Recruiter::class,'Email');
    }
}
