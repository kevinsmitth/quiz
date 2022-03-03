<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Level;
use App\Models\Question;
use App\Models\Ranking;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rankings = Ranking::groupBy('user_id')->select('user_id', DB::raw('COUNT(CASE WHEN answered_correctly = true THEN 1 END) AS total'))
            ->orderBy('total', 'desc')
            ->with('user')
            ->get();
        return view('home.index', compact('rankings'));
    }
}
