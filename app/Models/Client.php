<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'full_name',
        'picture',
        'logo',
        'alamat',
        'nohp',
        'status' // TAMBAHKAN INI
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tambahkan untuk logging perubahan status
    protected static function boot()
    {
        parent::boot();

        static::updating(function($client) {
            if ($client->isDirty('status')) {
                Log::info('Client Status Changing', [
                    'client_id' => $client->id,
                    'from' => $client->getOriginal('status'),
                    'to' => $client->status
                ]);
            }
        });
    }

    // Accessor untuk status (opsional)
    public function getStatusAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    // Mutator untuk status (opsional)
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ucfirst(strtolower($value));
    }
}