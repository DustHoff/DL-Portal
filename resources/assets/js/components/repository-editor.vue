<template>
    <div class="list-group">
        <div :is="repository.repository_type" v-for="repository in repositories" :key="repository.id" v-bind:repository="repository" v-bind:action="url+'/'+repository.id"/>
    </div>
</template>

<script>
export default {
    props: ["repositories","url"]
}
</script>