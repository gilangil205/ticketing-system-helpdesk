<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'topic',
        'title',
        'description',
        'attachment',
        'priority',
        'status',
        'ticket_number',
        'project_id',
        'developer_id',
    ];

    /**
     * Use ticket_number for route model binding (so URLs can use ticket_number).
     */
    public function getRouteKeyName()
    {
        return 'ticket_number';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            // Generate unique ticket number
            do {
                $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
                $numbers = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $ticketNumber = 'TCK-' . $letters . $numbers;
            } while (self::where('ticket_number', $ticketNumber)->exists());

            $ticket->ticket_number = $ticketNumber;

            // set user_id automatically if authenticated
            if (Auth::check()) {
                $ticket->user_id = Auth::id();
            }
        });
    }

    // Relasi ke User (Client yang buat ticket)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi ke Developer — developer disimpan di tabel users (developer_id -> users.id)
    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    // Histories
    public function histories()
    {
        return $this->hasMany(TicketHistory::class);
    }

    // Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
