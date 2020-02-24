<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);
        $question->answers()->create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);
        return back()->with(
            'success',
            'Your answer has been submated successfilly'
        );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        if ($this->authorize('update', $answer)) {
            // The current user can update the question...
            return view('answers.edit')
                ->with('answer', $answer)
                ->with('question', $question);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        if ($this->authorize('update', $answer)) {
            $answer->update($request->only('title', 'body'));
            return redirect()
                ->route('questions.show', $question->slug)
                ->with('success', '  Your answer has been updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        if ($this->authorize('delete', $answer)) {
            $answer->delete();
            return back()->with('success', '  Your answer has been deleted');
        }
    }
}