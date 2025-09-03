<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description','client_id'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

