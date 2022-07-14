<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\UserQuestionAnswer;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $questionAnswers = UserQuestionAnswer::with('questions.options')
                                    ->paginate(10);
        

        return view('backend.index', ['questionAnswers' => $questionAnswers]);
    }
}
