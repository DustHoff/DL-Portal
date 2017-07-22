@extends("layout.projectLayout")
@section("title",$project->name)
@section("content")
    <div class="jumbotron">
        <h1>{{$project->name}}</h1>
        <p class="lead">{{$project->desc}}</p>
    </div>
    <div id="artifacts" class="container">
    </div>
@endsection
@section("scripts")
    <script>
        $("#artifacts").load('{{route("artifact.list",compact("project"))}}');
    </script>
@endsection