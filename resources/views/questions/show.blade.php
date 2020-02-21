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
            <div class="card">
                <div class="card-header header-answers-of-question">
                    <div class="d-flex align-items-center ">
                        <h3>{{$question->answers_count.''.Str::plural(' Answer',$question->answers_count )}} </h3>
                    </div>
                </div>
                @php
                $number_answer=1;
                @endphp
                   @foreach ($question->answers as $answer)
                   <div class="media-body">
                        <div class="card-body">
                            <h4>{{'Answer : '.$number_answer}}</h4>
                                {!!$answer->body_html!!}
                            <div class="float-right">
                                <span class="text-muted">{{'Answered '.$answer->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$answer->user->url}}" class="pr-2">
                                        <img src="{{$answer->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                    <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @php
                    $number_answer++;
                    @endphp
                   @endforeach                
            </div>
        </div>
    </div>
</div>
@endsection
