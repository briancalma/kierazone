@extends('layouts.app')

@section('content')
    <h1>Post</h1>
    
    @if(!empty($posts))
        @foreach($posts as $post) 
            <div class="card">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col">
                            <img src="storage/coverImages/{{ $post->cover_image }}" style="width:100%">
                        </div>
                        <div class="col">
                            <a href="/post/{{ $post->id }}">
                                <h3>{{ $post->title }}</h3>
                            </a>
                            <small>{{ $post->created_at }}</small>
                            <small> by {{ $post->user->name }} </small>
                            <br>
                            @if( Auth::user()->id == $post->user->id )
                                <a href="post/{{$post->id}}/edit" class="btn btn-warning">EDIT</a>
                                {!! Form::open(['action' => ['PostsController@destroy',$post->id]],['class' => 'pull-right']) !!}
                                    {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                                    {{ Form::hidden('_method','DELETE') }}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div> 
            </div>
        @endforeach
        {{ $posts->links() }}
    @else
        <h3>No Post can be viewed.</h3>
    @endif

@endsection