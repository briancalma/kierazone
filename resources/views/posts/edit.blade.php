@extends('layouts.app')
@section('content')
    <h1>EDIT A Post</h1>
    {!! Form::open(['action' => ['PostsController@update',$post->id],'file' => true,'enctype' => 'multipart/form-data' ]) !!}
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',$post->title,['class' => 'form-control','placeholder' => '* Enter Title']) }}<br>
        {{ Form::label('body','Content') }}
        {{ Form::textarea('body',$post->body,['class' => 'form-control','placeholder' => '* Enter body']) }}<br>
        <img src="/storage/coverImages/{{$post->cover_image}}" style="width:100px;height:100px;">
        <br>
        {{ Form::file('cover_image') }}
        {{ Form::hidden('_method','PUT') }}
        <br><br>
        {{ Form::submit('Update Post',['class' => 'btn btn-success btn-lg']) }}
    {!! Form::close() !!}
@endsection