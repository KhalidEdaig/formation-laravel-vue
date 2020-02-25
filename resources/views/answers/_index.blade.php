<div class="row justify-content-center mt-4">
    <div class="col">
        <div class="card">
            <div class="card-header header-answers-of-question">
                <div class="d-flex align-items-center ">
                    <h3>{{$answersCount.''.Str::plural(' Answer',$answersCount )}} </h3>
                </div>
            </div>
            @php
            $number_answer=1;
            @endphp
               @foreach ($answers as $answer)
               <div class="media-body">
                    <div class="card-body">
                        <h4>{{'Answer : '.$number_answer}}</h4>
                            {!!$answer->body_html!!}
                            <div class="row">
                                <div class="col">
                                    <div class="float-left vote-control">
                                       {{--  Start Add vote --}}
                                        <div class="row">
                                            <div class="col">
                                                <a title="this answer is useful" 
                                                class="vote-up {{ Auth::guest() ? 'off' :''}}"
                                                onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"                      
                                                >
                                                    <i class="fas fa-caret-up fa-3x"></i>
                                                </a>
                                                <form action="/answers/{{$answer->id}}/vote{{-- {{route('questions.favorite',$question->id)}} --}}" id="up-vote-answer-{{ $answer->id }}" method="POST" style="display: none">
                                                    @csrf
                                                    <input type="hidden" value="1" name="vote">
                                                </form>
                                                <span class="votes-count">{{$answer->votes_count}}</span>
                                                <a title="this answer is not useful" 
                                                class="vote-down {{ Auth::guest() ? 'off' :''}}"
                                                onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $question->id }}').submit();"
                                                >
                                                    <i class="fas fa-caret-down fa-3x"></i>
                                                </a>
                                                <form action="/answers/{{$answer->id}}/vote" id="down-vote-answer-{{ $answer->id }}" method="POST" style="display: none">
                                                    @csrf
                                                    <input type="hidden" value="-1" name="vote">
                                                </form>
                                            </div> 
                                            
                                            <div class="col pt-2">
                                                @can('accept', $answer)
                                                    <a title="Marke this answer as best answer" 
                                                    class="{{$answer->status}}"
                                                        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();" >
                                                        <i class="fas fa-check fa-2x"></i>
                                                    </a> 
                                                    <form action="{{route('answers.accept',$answer->id)}}" id="accept-answer-{{ $answer->id }}" method="POST" style="display: none">
                                                        @csrf
                                                    </form>
                                                @else @if ($answer->is_best)
                                                    <a title="the question awner accepted this answer as best answer" 
                                                    class="{{$answer->status}}"
                                                        <i class="fas fa-check fa-2x"></i>
                                                    </a> 
                                                @endif  
                                                     
                                                @endcan                                                            
                                            </div>  
                                            
                                        </div>
                                        {{-- End Add vote --}}
                                    </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="d-flex justify-content-center rounded mt-4">
                                            <div class="col">
                                                @can('update', $answer) 
                                                <div class="edit mr-2">
                                                    <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-outline-success">Edit </a>
                                                </div>
                                                @endcan
                                            </div>
                                            <div class="col">
                                                @can('delete', $answer)                                         
                                                <div class="delete">
                                                    <form action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" method="post" class="form-delete">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure ?')">Delete </button>
                                                    </form> 
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                <div class="col">
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