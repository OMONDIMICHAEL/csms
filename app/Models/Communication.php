<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Communication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'scheduled_at',
        'admin_id',
    ];
    // protected $dates = ['scheduled_at']; // Ensures it's always treated as a Carbon instance
    //
    // public function getFormattedScheduledAtAttribute()
    // {
    //     return $this->scheduled_at ? $this->scheduled_at->format('d M Y, h:i A') : 'N/A';
    // }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
