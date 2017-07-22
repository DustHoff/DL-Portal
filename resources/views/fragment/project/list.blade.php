<ul class="list-group">
        <li class="list-group-item">
                <button class="btn btn-default" onclick="$('#popup-content').load('{{route("project.create")}}');$('#popup-window').modal('show');">Create Project</button>
        </li>
    @foreach($projects as $project)
        <a href="#" onclick="$('#popup-content').load('{{route("project.edit",compact("project"))}}');$('#popup-window').modal('show');" class="list-group-item">{{$project->name}}</a>
    @endforeach
</ul>