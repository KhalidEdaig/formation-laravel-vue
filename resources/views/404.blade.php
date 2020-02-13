@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col m-auto">
            <div class="card">
                <div class="card-header header-ask-question">
                    <div class="d-flex align-items-center ">
                        <h3>Access Denied </h3>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-success">Back to All Question</a>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                <img src="{{ asset('images/404.png') }}" alt="Access Denied" style="margin-left: 180px;" >
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
