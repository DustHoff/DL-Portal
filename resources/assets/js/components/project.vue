<template>
    <div class="list-group-item">
        <a href="#" class="list-group-item-heading" v-on:click="show=!show">{{ project.name }}</a>
        <div v-show="show" class="list-group-item-text">
                <select class="form-control" v-model="type">
                    <option value="div">create Repository</option>
                    <option value="Nexus-Repository">Nexus Repository</option>
                </select>
                <component  :is="type" v-on:requestRepository="createRepository"/>
            <repository-editor v-bind:url="this.url+'/'+this.project.route_key+'/repository'" v-bind:repositories="repositories"/>
        </div>
    </div>
</template>

<script>
export default {
    props: ["project","url"],
    data: function () {
        return {type: "div", show:false,repositories:[] }
    },
    created() {
        axios.get(this.url+'/'+this.project.route_key+'/repository')
            .then(response => {
                // JSON responses are automatically parsed.
                this.repositories = response.data
            })
    },
    methods: {
        createRepository: function (data) {
            delete data["type"];
            var json = JSON.stringify(data);
            axios.post(this.url+'/'+this.project.route_key+'/repository', json)
                .then(response => {
                    this.repositories = response.data;
                    this.type = "div";
                });
        }
    }
}
</script>