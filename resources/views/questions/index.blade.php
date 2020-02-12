@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header header-question">
                    <div class="d-flex align-items-center ">
                        <h3>All Questions </h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.create')}}" class="btn btn-outline-success">Ask Question</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts._alert')
                    @foreach ($questions as $question)
                   
                    <div class="media">
                        <div class="d-flex flex-column counters" >       
                        </div>
                        <div class="media-body">
                           <h3 class="mt-0">

                           <a {{-- href="{{ route('questions.show',$question->id)}}" --}}
                           href="{{$question->url}}"   
                            > 
                            {{$question->title }}</a>
                           </h3>
                           <p class="lead">
                            Asked by
                           <a href="{{$question->user->url}}">{{ $question->user->name }}</a>
                           <small class="text-muted ml-2">{{$question->created_date}}</small>
                        </p>
                            <p> {{Str::limit($question->body,200)}}</p>
                        </div>
                        
                    </div>
                    <div class="flex-container d-flex justify-content-center rounded">
                       
                            <div class="vote">
                            <strong>{{$question->votes}}</strong>
                            {{Str::plural('votes',$question->votes)}}
                            </div>
                   
                            <div class="answer {{$question->status}}{{--  unanswered answered   answered-accepted  --}}">
                                <strong>{{$question->answers}}</strong>
                                {{Str::plural('answers',$question->answers)}}
                            </div>
                       
                            <div class="view">
                            <strong>{{$question->views}}</strong>
                                {{Str::plural('views',$question->views)}} 
                            </div>    
                       
                    </div>
                    <hr>
                     @endforeach
               {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
