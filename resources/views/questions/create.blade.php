@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header header-ask-question">
                    <div class="d-flex align-items-center ">
                        <h3>Ask Question </h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-success">Back to All Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('questions.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="question-title">Question Titele</label>
                            <input type="text" name="title" id="question-title" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('title')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="question-body">Explain you question </label>
                            <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}">
                                
                            </textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('body')}}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success btn-lg">
                            Ask this question    
                            </button>
                        </div>

                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
