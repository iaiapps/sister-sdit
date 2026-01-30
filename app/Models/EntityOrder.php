<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByRole($query, $role)
    {
        if ($role && $role !== 'all') {
            return $query->where('role', $role);
        }
        return $query;
    }
}
