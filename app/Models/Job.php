<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table='job';
    protected $primaryKey = 'ID_Job';
    public $incrementing = false;

    protected $fillable=[
        'ID_Job',
        'JName'
    ];

    public function recruitment(){
        return $this->hasMany(Recruitment::class,'ID_Job');
    }
}
