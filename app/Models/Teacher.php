<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function child()
    {
        return $this->hasMany(Child::class);
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }

    public function presence()
    {
        return $this->hasMany(Presence::class);
    }

    public function salary()
    {
        return $this->hasMany(Salary::class);
    }

    public function salary_basic()
    {
        return $this->belongsTo(SalaryBasic::class);
    }

    public function salary_functional()
    {
        return $this->belongsTo(SalaryFunctional::class);
    }
}
