<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'graduate_id',
        'responses',
        'submitted_at',
    ];

    protected $casts = [
        'responses' => 'array',
        'submitted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function graduate()
    {
        return $this->belongsTo(Graduate::class);
    }
}


