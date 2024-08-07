<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replacement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // // dengan spesifik kolom
    // public function menggantikann()
    // {
    //     return $this->belongsTo(Teacher::class, 'menggantikan');
    // }
}
