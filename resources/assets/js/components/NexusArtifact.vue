<template>
    <div class="list-group-item">
        <div class="list-group-item-heading">{{ repository.repository_type }} Repository
            ({{ repository.configuration.url }})
            <a href="#" class="badge" v-on:click="artifacts.push({groupid:null,artifactid:null,classifier:null,extension:null})">add Artifact</a>
            <a href="#" class="badge" v-on:click="editing=!editing">edit Repository</a>
            <a href="#" class="badge">delete Repository</a>
        </div>
        <div class="list-group-item-text">
            <component v-show="editing" v-on:requestRepository="updateRepository" :is="repository.repository_type+'-Repository'" v-bind:default="configuration"/>
            <div v-show="!editing" class="row form-group" v-for="artifact in artifacts" :key="artifact.id">
                <div class="col-md-3">
                    <input class="form-control" v-bind:value="artifact.groupid" placeholder="groupid"/>
                </div>
                <div class="col-md-3">
                    <input class="form-control" v-bind:value="artifact.artifactid" placeholder="artifactid"/>
                </div>
                <div class="col-md-2">
                    <input class="form-control" v-bind:value="artifact.classifier" placeholder="classifier"/>
                </div>
                <div class="col-md-2">
                    <input class="form-control" v-bind:value="artifact.extension" placeholder="extension"/>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success" v-on:click="addElement(artifact)">save</button>
                    <button class="btn btn-danger" v-on:click="removeElement(artifact)">remove</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["action", "repository"],
    data() {
        return {artifacts: [], configuration: null, editing: false};
    },
    created() {
        this.configuration = this.repository.configuration;
        this.configuration.password = "";
        axios.get(this.action)
            .then(response => {
                // JSON responses are automatically parsed.
                this.artifacts = response.data
            })
    }
    , methods: {
        removeElement: function (artifact) {
            var index = this.artifacts.indexOf(artifact);
            this.artifacts.splice(index, 1);
        },
        addElement: function (artifact) {
            axios.post(this.action,JSON.stringify(artifact))
                .then(response => {
                    this.artifacts = response.data;
                });
        },
        updateRepository: function(data) {
            delete data["type"];
            axios.post(this.action+'/edit',JSON.stringify(data))
                .then(response => {
                    this.editing =false;
                })
        }
    }
}
</script>