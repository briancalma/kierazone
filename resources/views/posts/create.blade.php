@extends('layouts.app')
@section('content')
    <h1>Create A New Post</h1>
    {!! Form::open(['action' => 'PostsController@store']) !!}
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title','',['class' => 'form-control','placeholder' => '* Enter Title']) }}<br>
        {{ Form::label('body', 'Content') }}
        {{ Form::textarea('body','',['class' => 'form-control','placeholder' => '* Enter body']) }}<br>
        {{ Form::submit('POST',['class' => 'btn btn-success btn-lg']) }}
    {!! Form::close() !!}
@endsection