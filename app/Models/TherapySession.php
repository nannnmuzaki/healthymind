<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'therapist_id',
        'therapy_schedule_id',
        'is_paid',
        'session_link',
    ];

    /**
     * Get the user that owns the therapy session.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the therapist for the therapy session.
     */
    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }

    /**
     * Get the therapy schedule associated with the therapy session.
     */
    public function therapySchedule()
    {
        return $this->belongsTo(TherapySchedule::class);
    }
}