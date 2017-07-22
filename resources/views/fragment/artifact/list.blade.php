<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach($artifacts as $artifact)
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$artifact->artifactid}}"
                       aria-expanded="true" aria-controls="{{$artifact->artifactid}}">
                        {{$artifact->artifactid}}
                    </a>
                </h4>
            </div>
            <div id="{{$artifact->artifactid}}" class="panel-collapse collapse @if($loop->index==0) in @endif" role="tabpanel" aria-labelledby="{{$artifact->artifactid}}">
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($versions[$artifact->artifactid] as $version)
                            <a href="{{route("artifact.get",compact(["project","artifact","version"]))}}" class="list-group-item">{{$version}}</a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>