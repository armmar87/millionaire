<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $fillable = ['title', 'level', 'step', 'point'];
    protected $appends = ['point'];
    public $timestamps = false;

    const LOW = 'low';
    const MEDIUM = 'medium';
    const HARD = 'hard';
    const VERY_HARD = 'very_hard';

    const LEVELS = [
        self::LOW => 5,
        self::MEDIUM => 10,
        self::HARD => 15,
        self::VERY_HARD => 20,
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    function getPointAttribute()
    {
        return self::LEVELS[$this->level];
    }

    public static function getRandomId($play): int
    {
        $question = self::query();
        $question->whereNotIn('id', $play->question_ids);
        $questionIds = $question->pluck('id');

        return $questionIds->toArray()[rand(0, $questionIds->count() - 1)];
    }
}
