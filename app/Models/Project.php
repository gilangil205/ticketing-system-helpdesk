<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi ke Ticket
     * Satu Project bisa punya banyak Ticket
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
