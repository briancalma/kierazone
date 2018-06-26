@extends("layouts.app")

@section("content")
    <div class="jumbotron">
        <h1 class="display-4">{{ $title }}</h1>
        <p class="lead">This is Kiera Zone a blog platform which you can use to create things.</p>
        <hr class="my-4">
        <p>Supporting text for you!</p>
        <p class="lead">
          <a class="btn btn-primary btn-md " href="#" role="button">Login</a>
          <a class="btn btn-success btn-md" href="#" role="button">SignUp</a>
        </p>
    </div>
@endsection
