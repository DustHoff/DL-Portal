@extends("layout.projectLayout")
@section("title",$project->name)
@section("content")
    <div class="jumbotron">
        <h1>{{$project->name}}</h1>
        <p class="lead">{{$project->desc}}</p>
    </div>
    <div class="container">
        @foreach( $project->repositories as $repository)
            <Repository url="{{route("repository",compact("repository"))}}"></Repository>
        @endforeach
    </div>
@endsection
@section("scripts")
@endsection