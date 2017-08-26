<template>
    <div class="list-group" style="overflow-y: scroll; height: 200px">
        <div v-show="loading" class="progress" style="margin-top: 75px">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                <span> Loading </span>
            </div>
        </div>
        <a v-bind:href="url+'/'+version" v-for="version in versions" class="list-group-item">{{ version }}</a>
    </div>
</template>

<script>
    export default {
        props: ["url"],
        data() { return {versions:[],loading:true}},
        created() {
            axios.get(this.url)
                .then(response => {
                // JSON responses are automatically parsed.
                this.versions = response.data;
                this.loading = false;
        })
        }
    }
</script>