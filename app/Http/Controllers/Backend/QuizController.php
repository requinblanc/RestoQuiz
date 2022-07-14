<?php

namespace App\Http\Controllers\Backend;

use App\Models\Quiz;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuizInvite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function __construct(
        Quiz $quiz,
        Option $option,
        Question $question,
        QuizInvite $quizInvite
    ){
        $this->quiz = $quiz;
        $this->option = $option;
        $this->question = $question;
        $this->quizInvite = $quizInvite;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizs = $this->quiz->all();

        return view('backend.quiz.index', ['quizs' => $quizs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizs = $this->quiz->all();

        return view('backend.quiz.create', ['quizs' => $quizs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $slug = $this->makeSlug($request->name);
        $quiz = new $this->quiz;

        $quiz->name = $request->name;
        $quiz->slug = $slug;
        $quiz->save();
        
        return redirect()->action([QuizController::Class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $type = $request->type;
        
        $quiz = $this->quiz->where('slug', $slug)->firstOrFail();
        
        $questions = $this->question->with('options')
                                ->where('quiz_id', $quiz->id)->get();

        return view('backend.quiz.edit', [
                                        'quiz' => $quiz,
                                        'questions' => $questions,
                                        'type' => $type
                                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
         // DB::transaction(function() use ($slug, $request) {
            
            $this->validate($request, [
                'question' => 'required',
                'options.*' => 'required'
            ]);
        
        $type = $request->type;
        
        $quiz = $this->quiz->where('slug', $slug)->firstOrFail();

        //update question to db
        $question = new Question;
        $question->quiz_id  = $quiz->id;
        $question->question = $request->question;
        $question->type = $request->type;
        $question->is_active = 1;
        $question->save();

        $saveOption = (new SaveQuizOption)->saveOptions($request, $question, $type);
        
    // });
    
    return redirect()->route('quiz.edit', $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        DB::transaction(function() use ($request){
            $quiz = $this->quiz->with('questions.options')->where('id', $request->id);
            $quiz->delete();
        });

        return redirect()->route('quiz.index')->with('success', 'Record deleted successfully.');
    }

    /** make slug from title */
    public function makeSlug($name)
    {

        $slug = Str::slug($name);

        $count = Quiz::where('slug', 'LIKE', '%'. $slug . '%')->count();

        $addCount = $count + 1;

        return $count ? "{$slug}-{$addCount}" : $slug;
    }

    public function accept($slug, $token)
    {
        
        $quiz = $this->quiz->with('questions.options')->where('slug', $slug)->firstOrFail();
        
        return view('frontend.quiz.index', ['quiz' => $quiz, 
                                            'token' => $token]);
    }

    public function answer(Request $request)
    {
        $invite = $this->quizInvite->where('token', $request->token)->first();
        $email = $invite->email;

        $isAnswerSaved = (new SaveQuizAnswer)->answer($email, $request);
        if ($isAnswerSaved)
            return redirect()->route('home')->with('success', 'Test Completed.');
        else
            return redirect()->route('home')->with('error', 'Something went wrong.');
    }
}
