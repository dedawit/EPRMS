<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function labRequests()
    {
        return $this->hasMany(LabRequest::class, 'history_id');
    }
}
