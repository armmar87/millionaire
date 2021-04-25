<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAnswerRequest;
use App\Models\Play;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class PlayController extends Controller
{

    public function index()
    {
        $play = Play::where('user_id', Auth::id())
            ->orderBy('step', 'DESC')
            ->orderBy('attempt', 'DESC')
            ->first();
        $question = Question::with('answers')->where('id', Question::getRandomId($play))->first();

        return compact('play', 'question');
    }

    public function addAnswer(AddAnswerRequest $request)
    {
        $question = Question::find($request->question_id);

        $play = Play::where('user_id', Auth::id())
            ->orderBy('step', 'DESC')
            ->orderBy('attempt', 'DESC')
            ->first();
        if (!$play) {
            $play = new Play();
        }

        $questionIds = $play->question_ids ?? [];
        array_push($questionIds, $request->question_id);
        $point = $request->correct_answer ? Question::LEVELS[$question->level] : 0;
        $play->user_id = Auth::id();
        $play->point = $play->point + $point;
        $play->question_ids = $questionIds;
        $play->step = $play->step ? $play->step + 1 : 2;


        return $play->save();
    }
}
