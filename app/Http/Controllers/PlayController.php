<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAnswerRequest;
use App\Models\Play;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class PlayController extends Controller
{
    private $model;

    public function __construct(Play $play)
    {
        $this->model = $play;
    }

    public function index()
    {
        $play = $this->model::firstOrCreate(['user_id' => Auth::id()])->orderBy('attempt', 'DESC')->first();
        $question = Question::with('answers')->whereId(Question::getRandomId($play))->first();

        return compact('play', 'question');
    }

    public function score()
    {
        $play = $this->model::select('point')
            ->where(['user_id' => Auth::id(), 'step' => 5])
            ->orderBy('id', 'DESC')
            ->first();

        return $play;
    }

    public function addAnswer(AddAnswerRequest $request)
    {
        $question = Question::find($request->question_id);

        $play = $this->model::where('user_id', Auth::id())->orderBy('attempt', 'DESC')->first();
        $lastStep = $play->step === 5;
        $questionIds = $play->question_ids;
        array_push($questionIds, $request->question_id);
        $point = $request->correct_answer ? Question::LEVELS[$question->level] : 0;
        $play->point = $play->point + $point;
        $play->question_ids = $questionIds;
        $lastStep ?: $play->step++;
        $play->save();

        if ($lastStep) {
            $play = $this->model;
            $play->user_id = Auth::id();
            $play->attempt = $this->model::where('user_id', Auth::id())->count() + 1;
            $play->save();
        }

        return $play;
    }
}
