<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use HasFactory;

    protected $table = 'plays';
    protected $fillable = ['user_id', 'attempt', 'step', 'point'];
    protected $casts = ['question_ids' => 'array'];
    public $timestamps = false;
}
