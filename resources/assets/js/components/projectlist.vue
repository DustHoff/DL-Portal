<template>
    <div class="list-group">
        <project v-for="project in projects" :key="project.id" v-bind:project="project"
                 v-bind:url="url"/>
    </div>
</template>

<script>
export default {
    props: ["url"],
    data() {
        return {projects: []};
    },
    created() {
        axios.get(this.url)
            .then(response => {
            // JSON responses are automatically parsed.
            this.projects = response.data
    })
    }
}
</script>