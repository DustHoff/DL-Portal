
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("project",require("./components/project.vue"));
Vue.component("projectlist",require("./components/projectlist.vue"));
Vue.component("repository-editor",require("./components/repository-editor.vue"));
Vue.component("Nexus",require("./components/NexusArtifact.vue"));
Vue.component("Nexus-Repository",require("./components/NexusRepository.vue"));
Vue.component("repository", require("./components/repository.vue"));
Vue.component("versions", require("./components/versions.vue"));


new Vue({
    el: "#vueapp"
})
