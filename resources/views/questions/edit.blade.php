@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header header-ask-question">
                    <div class="d-flex align-items-center ">
                        <h3>Edit Question </h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-success">Back to All Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('questions.update',[$question->id])}}" method="post">
                        @method('PUT')
                        @include('questions._form',['btnText'=>'Update Question'])
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
