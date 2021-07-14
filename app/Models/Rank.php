<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $table='ranks';
    protected $primaryKey = 'ID_Rank';
    public $incrementing = false;
    protected $fillable=[
        'ID_Rank',
        'RName'
    ];
    public function applicant(){
        return $this->hasMany(Applicants::class);
    }
}
