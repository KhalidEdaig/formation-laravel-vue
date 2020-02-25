<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Question;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    //Relationship  user with answer
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;
        return 'https://www.gravatar.com/avatar/' .
            md5(strtolower(trim($email))) .
            '?s=' .
            $size;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function getUrlAttribute()
    {
        //return route('questions.show', $this->slug /* $this->id */);
    }

    public function favorites()
    {
        return $this->belongsToMany(
            Question::class,
            'favorites'
        )->withTimestamps();
    }

    //relationship Many to Many polymorphic
    public function voteQuestions()
    {
        return $this->morphedByMany(
            Question::class,
            'votable'
        )->withTimestamps();
    }
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable')->withTimestamps();
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        $this->_vote($voteQuestions, $question, $vote);
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswers = $this->voteAnswers();
        $this->_vote($voteAnswers, $answer, $vote);
    }

    private function _vote($ralationship, $modele, $vote)
    {
        if ($ralationship->where('votable_id', $modele->id)->exists()) {
            $ralationship->updateExistingPivot($modele, ['vote' => $vote]);
        } else {
            $ralationship->attach($modele, ['vote' => $vote]);
        }
        $modele->load('votes');
        $downVotes = (int) $modele->downVotes()->sum('vote');
        $upVotes = (int) $modele->upVotes()->sum('vote');
        $modele->votes_count = $downVotes + $upVotes;
        $modele->save();
    }
}