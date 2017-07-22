@if(isset($project))
    <form id="form" action="{{route("project.update",compact("project"))}}" method="post" class="form-horizontal">
@else
    <form id="form" action="{{route("project.store")}}" method="post" class="form-horizontal">
@endif
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            <h4>Create Project</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input id="name" class="form-control" name="name" value="{{$project->name or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea id="description" name="desc" class="form-control">{{$project->desc or ''}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="url" class="col-sm-2 control-label">Nexus Repository URL</label>
                <div class="col-sm-10">
                    <input id="url" class="form-control" name="url" value="{{$project->configuration->url or ''}}">
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Nexus Username</label>
                <div class="col-sm-10">
                    <input id="username" class="form-control" name="username" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Nexus Password</label>
                <div class="col-sm-10">
                    <input id="password" class="form-control" name="password" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="artifacts" class="col-sm-2 control-label">Artifacts</label>
                <div id="artifacts" class="col-sm-10">
                    <button type="button" class="btn btn-default" onclick="$('#item').clone().appendTo('#list');" value="false">add</button>
                    <table class="table">
                        <thead>
                        <tr>
                            <td>Group ID</td>
                            <td>Artifact ID</td>
                            <td>Classifier</td>
                            <td>Extension</td>
                            <td>&nbsp;</td>
                        </tr>
                        </thead>
                        <tbody id="list">
                        @if(isset($project))
                            @foreach($project->configuration->artifacts as $artifact)
                            <tr id="item">
                                <td><input name="groupid[]" class="form-control" value="{{$artifact->groupid}}"></td>
                                <td><input name="artifactid[]" class="form-control" value="{{$artifact->artifactid}}"></td>
                                <td><input name="classifier[]" class="form-control" value="{{$artifact->classifier}}"></td>
                                <td><input name="extension[]" class="form-control" value="{{$artifact->extension}}"></td>
                                <td><button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()" value="false">remove</button> </td>
                            </tr>
                            @endforeach
                        @else
                            <tr id="item">
                                <td><input name="groupid[]" class="form-control"></td>
                                <td><input name="artifactid[]" class="form-control"></td>
                                <td><input name="classifier[]" class="form-control"></td>
                                <td><input name="extension[]" class="form-control"></td>
                                <td><button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()" value="false">remove</button> </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
            {{csrf_field()}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</form>