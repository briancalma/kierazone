@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Dashboard</h1></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                        <h3>Create A New Post</h3>
                        {!! Form::open(['action' => 'PostsController@store','file' => true,'enctype' => 'multipart/form-data']) !!}
                            {{ Form::label('title', 'Title') }}
                            {{ Form::text('title','',['class' => 'form-control','placeholder' => '* Enter Title']) }}<br>
                            {{ Form::label('body', 'Content') }}
                            {{ Form::textarea('body','',['class' => 'form-control','placeholder' => '* Enter body']) }}<br>
                            {{ Form::file('cover_image') }}<br><br>
                            {{ Form::submit('POST',['class' => 'btn btn-success btn-lg']) }}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Your Posts</h1></div>
    
                    <div class="card-body">
                        @if(!empty($posts))
                            <table>
                                <thead>
                                    <th></th>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                           
                                @foreach($posts as $post)
                                    <tr>
                                        <td><img src="storage/coverImages/{{$post->cover_image}}" width="200px" height="200px;"></td>
                                        <td><a href="/post/{{$post->id}}"><h5>{{$post->title}}</h5></a></td>
                                        <td><a href="post/{{$post->id}}/edit" class="btn btn-warning">EDIT</a></td>
                                        <td>
                                            {!! Form::open(['action' => ['PostsController@destroy',$post->id]],['class' => 'pull-right']) !!}
                                                {{ Form::submit('Delete',['class' => 'btn btn-danger']) }}
                                                {{ Form::hidden('_method','DELETE') }}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                        @endif
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
