@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card mt-4">
                <div class="card-header header-ask-question">
                    <div class="d-flex align-items-center ">
                        <h3>{{$question->title}} </h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-success">Back to All Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!!$question->body_html!!}
                    <div class="row">
                        <div class="col">
                            <div class="float-left vote-control">
                               {{--  Start Add vote --}}
                                <div class="row">
                                    <div class="col">
                                    <a title="this question is useful" class="vote-up">
                                        <i class="fas fa-caret-up fa-3x"></i>
                                    </a>
                                    <span class="votes-count">100</span>
                                    <a title="this question is not useful" class="vote-down off">
                                        <i class="fas fa-caret-down fa-3x"></i>
                                    </a>
                                    </div>
                                    <div class="col pt-2">
                                    <a title="Click to make as favorite question (Click again to undo)" 
                                    class=" vote-star favorite 
                                    {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' :'')}}"
                                    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();" >
                                
                                        <i class="fas fa-star fa-2x"></i>
                                    </a>
                                    <form action="/questions/{{$question->id}}/favorites{{-- {{route('questions.favorite',$question->id)}} --}}" id="favorite-question-{{ $question->id }}" method="POST" style="display: none">
                                        @csrf
                                        @if ($question->is_favorited)
                                            @method('DELETE')
                                        @endif
                                    </form>
                                <span class="favorites-count">{{$question->favorites_count}}</span>                              
                                    </div>
                                </div>
                                {{-- End Add vote --}}
                            </div>
                            <div class="col">
                                <div class="float-right">
                                    <span class="text-muted">{{'Answered '.$question->created_date}}</span>
                                    <div class="media mt-2">
                                        <a href="{{$question->user->url}}" class="pr-2">
                                            <img src="{{$question->user->avatar}}" alt="">
                                        </a>
                                        <div class="media-body mt-1">
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@include('layouts._alert')
  @include('answers._index',[
      'answersCount'=>$question->answers_count,
      'answers'=>$question->answers
  ])
  @include('answers._create',['btnText'=>'Response'])  
</div>
@endsection
