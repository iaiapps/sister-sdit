<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $with = ['teacher'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function late()
    {
        return $this->hasOne(Late::class);
    }
}
