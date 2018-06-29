@extends('layouts.app')

@section('content')    
    <div class="card">
        <div class="card-body">                 
            <h1>{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
            <small>{{ $post->created_at }}</small> 
        </div>
    </div>
    <br>
    <a href="/post" class="btn btn-lg btn-warning">Back</a>
@endsection