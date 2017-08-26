<template>
    <div>
        <form class="form-horizontal" v-on:submit.prevent="createNexusRepository">
            <div class="form-group">
                <label class="control-label col-md-3">Nexus Repository URL</label>
                <div class="col-md-9">
                    <input class="form-control" v-model="data.url"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Nexus Repository Username</label>
                <div class="col-md-9">
                    <input class="form-control" v-model="data.username"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3">Nexus Repository Password</label>
                <div class="col-md-9">
                    <input type="password" class="form-control" v-model="data.password"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <input class="btn btn-default" type="submit"/>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['default'],
    data() {
        return {data : {url: "", username: "", password: ""}}
    },
    mounted() {
        if ( this.default !=null) this.data = this.default;
    },
    methods: {
        createNexusRepository: function (event) {
            console.log(this.data);
            this.$emit('requestRepository',this.data);
        }
    }
}
</script>