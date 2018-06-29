@extends('layouts.app')

@section('content')
    <h1>Post</h1>
    
    @if(!empty($posts))
        @foreach($posts as $post) 
            <div class="card">
                <div class="card-body">                 
                    <a href="/post/{{ $post->id }}">
                        <h3>{{ $post->title }}</h3>
                    </a>
                    <small>{{ $post->created_at }}</small><br>
                    <a href="post/{{$post->id}}/edit" class="btn btn-warning">EDIT</a>
                    {!! Form::open(['action' => ['PostsController@destroy',$post->id]],['class' => 'pull-right']) !!}
                        {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                        {{ Form::hidden('_method','DELETE') }}
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    @else
        <h3>No Post can be viewed.</h3>
    @endif

@endsection