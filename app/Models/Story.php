<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'story',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['number_of_questions'];


    public function getNumberOfQuestionsAttribute(): int
    {
        return $this->questions()->count();
    }


    /**
     * Get all of the questions for the Story
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'story_id', 'id');
    }
}
