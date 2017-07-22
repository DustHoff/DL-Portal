@extends("layout.controlLayout")
@section("content")
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">Projects</a>
        </li>
        <li role="presentation">
            <a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a>
        </li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="projects"></div>
        <div role="tabpanel" class="tab-pane" id="users"></div>
    </div>
@endsection
@section("scripts")
    <script>
        $("#projects").load('{{route("project.list")}}');
    </script>
@endsection
