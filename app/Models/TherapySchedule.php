<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapySchedule extends Model
{
    use HasFactory;

    protected $fillable = ['therapist_id', 'start_time', 'end_time'];

    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id');
    }
}