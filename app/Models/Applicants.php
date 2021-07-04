<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    protected $table='applicants';
    protected $primaryKey = 'ID_Applicants';

    public $incrementing = false;
    protected $fillable=[
        'ID_Applicants',
        'Email',
        'FirstName',
        'LastName',
        'Gender',
        'PhoneNumber',
        'DateOfBirth',
        'Locat',
        'Assess',
        'CV',
        'Avatar',
        'Cover',
        'ID_Work',
        'ID_Qualifications',
        'ID_Rank'
    ];
    public function Work(){
        return $this->belongsTo(Work::class,'ID_Work');
    }
    public function Qualifications(){
        return $this->belongsTo(Qualifications::class,'ID_Qualifications');
    }
    public function Rank(){
        return $this->belongsTo(Rank::class,'ID_Rank');
    }
    public function Account(){
        return $this->belongsTo(Account::class,'Email');
    }
}
