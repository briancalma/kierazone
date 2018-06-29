@extends('layouts.app')
@section('content')
    <h1>EDIT A Post</h1>
    {!! Form::open(['action' => ['PostsController@update',$post->id]]) !!}
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',$post->title,['class' => 'form-control','placeholder' => '* Enter Title']) }}<br>
        {{ Form::label('body','Content') }}
        {{ Form::textarea('body',$post->body,['class' => 'form-control','placeholder' => '* Enter body']) }}<br>
        {{ Form::hidden('_method','PUT') }}
        {{ Form::submit('Update Post',['class' => 'btn btn-success btn-lg']) }}
    {!! Form::close() !!}
@endsection