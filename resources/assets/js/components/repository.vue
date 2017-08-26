<template>
    <div>
        <i  v-show="loading" class="fa fa-spinner fa-spin"></i>
        <div class="col-md-3 col-sm-4" v-for="artifact in artifacts">
            <div class="panel panel-success">
                <div class="panel-heading">{{ artifact.artifactid }}</div>
                    <versions v-bind:url="url+'/'+artifact.id"></versions>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["url"],
    data() {
        return {artifacts: [],loading:true};
    },
    created() {
        axios.get(this.url)
            .then(response => {
            // JSON responses are automatically parsed.
            this.artifacts = response.data
    })
    }
}
</script>