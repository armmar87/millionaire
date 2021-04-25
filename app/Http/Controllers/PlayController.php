<?php

namespace App\Http\Controllers;

use App\Models\Play;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class PlayController extends Controller
{

    public function index()
    {
        $play = Play::where('user_id', Auth::id())->orderBy('game', 'desc')->first();
        $question = Question::with('answers')->where('id', Question::getRandomId($play))->first();

        return compact('play', 'question');
    }
}
