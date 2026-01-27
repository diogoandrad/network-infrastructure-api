<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $fillable = [
        'network_id',
        'name',
        'description',
        'ip_addresses',
        'mac_address',
        'device_type',
        'os',
        'status',
    ];

    protected $casts = [
        'ip_addresses' => 'array',
    ];

    public function network()
    {
        return $this->belongsTo(Network::class);
    }

    public function scopeOnline($query)
    {
        return $query->where('status', 'online');
    }
}
