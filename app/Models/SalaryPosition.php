<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPosition extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    //model realtionship belongTo dengan custom foreignid sesuai nama kolom pada tabel 
    public function salary_pokok()
    {
        return $this->belongsTo(SalaryType::class, 'pokok');
    }
    public function salary_fungsional()
    {
        return $this->belongsTo(SalaryType::class, 'fungsional');
    }
}
