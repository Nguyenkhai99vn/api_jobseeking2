<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table='work';
    protected $primaryKey = 'ID_Work';
    public $incrementing = false;
    protected $fillable= [
        'ID_Work',
        'WName'
    ];
    public function applicant(){
        return $this->hasMany(Applicants::class,'ID_Work');
    }
}
