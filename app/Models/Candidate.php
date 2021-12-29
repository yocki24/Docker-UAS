<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'user_id',
        'order',
        'vision',
        'mision',
        'youtube',
        'photo',
    ];

    /**
     * Get all of the comments for the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vote()
    {
        return $this->hasMany(Vote::class, 'candidate_id', 'id');
    }

    /**
     * Get the user that owns the Candidate
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}