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
                                            <a title="this question is useful" class="vote-up">
                                                <i class="fas fa-caret-up fa-3x"></i>
                                            </a>
                                            <span class="votes-count">100</span>
                                            <a title="this question is not useful" class="vote-down off">
                                                <i class="fas fa-caret-down fa-3x"></i>
                                            </a>
                                            </div>
                                            <div class="col pt-2">
                                            <a title="Marke this answer as best answer" class="vote-accepted">
                                                <i class="fas fa-check fa-2x"></i>
                                            </a>                     
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