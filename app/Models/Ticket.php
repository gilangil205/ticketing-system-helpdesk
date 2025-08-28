<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
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
        'developer_id', // tambahkan developer_id
    ];

    public function getRouteKeyName()
    {
        return 'ticket_number';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            do {
                $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3));
                $numbers = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $ticketNumber = 'TCK-' . $letters . $numbers;
            } while (self::where('ticket_number', $ticketNumber)->exists());

            $ticket->ticket_number = $ticketNumber;
        });
    }

    // ➕ Relasi ke Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // ➕ Relasi ke Developer
    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function histories()
{
    return $this->hasMany(TicketHistory::class);
}

    public function comments() {
    return $this->hasMany(Comment::class);
}


}
