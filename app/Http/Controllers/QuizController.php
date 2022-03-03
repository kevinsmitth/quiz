<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Ranking;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $rankings = Ranking::groupBy('user_id')->select('user_id', DB::raw('COUNT(CASE WHEN answered_correctly = true THEN 1 END) AS total'))
            ->orderBy('total', 'desc')
            ->with('user')
            ->get();
        $questions = [];
        $user_level = [];
        $user_ranking = [];
        if (Auth::check()) {
            $user_level = UserLevel::where('user_id', Auth::user()->id)->first();
            $user_ranking = Ranking::where('user_id', Auth::user()->id)->first();

            if ($user_ranking && $user_level) {
                $questions = Question::whereHas(
                    'level',
                    function ($query) use ($user_level) {
                        $query->where('level', $user_level->actual_level);
                        $query->where('step', $user_level->actual_step);
                    }
                )
                    ->first();
            } else {
                $questions = Question::whereHas(
                    'level',
                    function ($query) use ($user_level) {
                        $query->where('level', $user_level->actual_level);
                        $query->where('step', 1);
                    }
                )
                    ->first();
            }
        }

        return view('quiz.index', compact('questions', 'user_level', 'rankings'));
    }

    public function check_answer(Request $request)
    {
        $answer = $request->answer;
        $question = Question::where('id', $request->question_id)->first();
        $answer_right = Answer::where('status', 1)->whereHas(
            'questions',
            function ($query) use ($question) {
                $query->where('id', $question->id);
            }
        )->first();
        $user_level = UserLevel::where('user_id', Auth::user()->id)->first();

        if ($answer == $answer_right->answer) {
            if ($user_level->actual_step < 5) {
                $user_level->actual_step += 1;
            } else {
                $user_level->actual_step = 1;
                $user_level->actual_level += 1;
            }
            $user_level->update();

            $user_ranking = new Ranking();
            $user_ranking->user_id = Auth::user()->id;
            $user_ranking->question_id = $question->id;
            $user_ranking->answered_correctly = 1;
            $user_ranking->save();

            return response()->json($answer_right);
        } else {
            if ($user_level->actual_step < 5) {
                $user_level->actual_step += 1;
            } else {
                $user_level->actual_step = 1;
                $user_level->actual_level += 1;
            }
            $user_level->update();

            $user_ranking = new Ranking();
            $user_ranking->user_id = Auth::user()->id;
            $user_ranking->question_id = $question->id;
            $user_ranking->answered_correctly = 0;
            $user_ranking->save();
        }
        return response()->json('Errou');
    }

    public function next_question(Request $request)
    {
        $rankings = Ranking::groupBy('user_id')->select('user_id', DB::raw('COUNT(CASE WHEN answered_correctly = true THEN 1 END) AS total'))
            ->orderBy('total', 'desc')
            ->with('user')
            ->get();
        $questions = [];
        $user_level = [];
        $user_ranking = [];
        if (Auth::check()) {
            $user_level = UserLevel::where('user_id', Auth::user()->id)->first();
            $user_ranking = Ranking::where('user_id', Auth::user()->id)->first();

            if ($user_ranking && $user_level) {
                $questions = Question::whereHas(
                    'level',
                    function ($query) use ($user_level) {
                        $query->where('level', $user_level->actual_level);
                        $query->where('step', $user_level->actual_step);
                    }
                )
                    ->first();
            } else {
                $questions = Question::whereHas(
                    'level',
                    function ($query) use ($user_level) {
                        $query->where('level', $user_level->actual_level);
                        $query->where('step', 1);
                    }
                )
                    ->first();
            }
        }
        if ($request->ajax()) {
            $view = view('steps.index', compact('questions', 'user_level', 'rankings'))->render();
            return response($view);
        }
        return view('quiz.index', compact('questions', 'user_level', 'rankings'));
    }
}
