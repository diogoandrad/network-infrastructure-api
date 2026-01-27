<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Network extends Model
{
    use HasFactory;

    protected $table = 'networks';

    protected $fillable = [
        'name',
        'description',
        'cidr',
        'location',
        'status',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
