<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Str;

class Question extends Model
{
    use VotableTrait;
    protected $fillable = ['title', 'body'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relationship the Question with answer
    public function answers()
    {
        return $this->hasMany(Answer::class);

        //$questions->answers->count()
        //foreach(questions->answers as answer)
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug /* $this->id */);
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return 'answered-accepted';
            }
            return 'answered';
        }
        return 'unanswered';
    }
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    public function isFavorite()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorite();
    }
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}