<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'full_name',
        'rate',
        'role',
        'last_login', // ✅ pastikan ini sesuai dengan nama kolom di tabel database
        'phone', // ✅ tambahkan
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime', // ✅ casting datetime untuk memudahkan format tanggal
        'rate' => 'decimal:2',
    ];

    // ✅ Helper methods untuk cek role
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isClient()
    {
        return $this->role === 'Client';
    }

    public function isDeveloper()
    {
        return $this->role === 'Developer';
    }

    public function isProjectManager()
    {
        return $this->role === 'Project Manager';
    }

    public function isQAMaster()
    {
        return $this->role === 'QA Master';
    }
}
