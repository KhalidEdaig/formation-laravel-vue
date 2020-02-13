<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //DB::enableQueryLog();
        return view('questions.index')->with('questions', Question::with('user')->latest()->paginate(3));
        //dd(DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();

        return view('questions.create')->with('question', $question);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        //dd("store");
        $request->user()->questions()->create($request->only('title', 'body'));
        //redirect('/questions')
        return redirect()->route('questions.index')->with("success", "   Your question has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        /*  if (Gate::denies('update-question', $question)) {
            return view('404');
        } */
        if ($this->authorize('update', $question)) {
            // The current user can update the question...
            return view('questions.edit')->with('question', $question);
        }

        /*  return view('403'); */



        //abort(403, 'Access Denied');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {

        if ($this->authorize('update', $question)) {
            $question->update($request->only('title', 'body'));
            return redirect('/questions')->with('success', "  Your question has been updated");
        }
        /*  return view('403'); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        /* if (Gate::denies('delete-question', $question)) {
            return view('404');
        } */
        if ($this->authorize('delete', $question)) {
            $question->delete();
            return redirect('/questions')->with('success', "  Your question has been deleted");
        }

        /*  return view('403'); */
    }
}