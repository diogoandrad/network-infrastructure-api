<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Device extends Model
{
    use HasFactory;
    use HasUlids;

    protected $table = 'devices';

    protected $keyType = 'string';
    public $incrementing = false;

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
