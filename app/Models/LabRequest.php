<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRequest extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function medicalHistory()
    {
        return $this->belongsTo(MedicalHistory::class, 'history_id');
    }

}
