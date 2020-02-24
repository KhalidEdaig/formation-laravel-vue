<div class="row justify-content-center mt-4">
    <div class="col">
        <div class="card">
            <div class="card-header header-writing-answer">
                <div class="d-flex align-items-center ">
                    <h3>Writing your answer </h3>
                </div>
            </div>
        <form action="{{route('questions.answers.store',$question->id)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="answer-body">Explain your answer </label>
                <textarea name="body" id="answer-body" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">
                </textarea>
                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        <strong>{{$errors->first('body')}}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-outline-success btn-lg">
                {{$btnText}}    
                </button>
            </div>
          </form>
        </div>
    </div>
</div>