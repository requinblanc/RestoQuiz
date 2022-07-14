<?php

namespace App\Http\Controllers\Backend;

use App\Models\Option;
use App\Models\Question;
use App\Models\QuizInvite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizShareController extends Controller
{
    public function __construct(
        Quiz $quiz,
        Question $question,
        Option $option,
        QuizInvite $quizInvite
    ){
        $this->quiz = $quiz;
        $this->question = $question;
        $this->option = $option;
        $this->quizInvite = $quizInvite;
    }
    public function invite(Request $request, $slug)
    {
        do {
            $token = Str::random(16);
        }
        while ($this->quizInvite->where('token', $token)->first());
        
        $quizInvite = $this->quizInvite->create([
                                'email' => $request->email,
                                'token' => $token
                            ]);

        $quiz = $this->quiz->with('questions.options')->where('slug', $slug)->firstOrFail();

        Mail::to($request->email)->send(new QuizInviteMail($quiz, $token));

        return redirect()->back()->with('success', 'User has been invited for quiz.');
    }

    public function accept($token)
    {
        $invite = $this->quizInvite->where('token', $token)->first();

        return redirect()->route('home')->with('success', ' Test completed.');
    
    }
}
