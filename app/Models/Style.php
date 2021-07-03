<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table='style';
    protected $primaryKey = 'ID_Style';
    public $incrementing = false;
    protected $fillable=[
        'ID_Style',
        'SName'
    ];

    public function recruitment(){
        return $this->hasMany(Recruitment::class,'ID_Style');
    }
}
