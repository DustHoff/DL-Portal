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
        <button type="button" class="btn btn-default" onclick="$('#item').clone().appendTo('#list');" value="false">
            add
        </button>
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
                        <td>
                            <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"
                                    value="false">remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr id="item">
                    <td><input name="groupid[]" class="form-control"></td>
                    <td><input name="artifactid[]" class="form-control"></td>
                    <td><input name="classifier[]" class="form-control"></td>
                    <td><input name="extension[]" class="form-control"></td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="$(this).parent().parent().remove()"
                                value="false">remove
                        </button>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
    </div>
</div>