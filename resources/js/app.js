/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import App from "./components/App.vue";
import PostIndex from "./components/Posts/Index.vue";
import PostCreate from "./components/Posts/Create.vue";
import PostEdit from "./components/Posts/Edit.vue";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'app',
            component: App
        },
        {
            path: '/posts',
            name: 'posts.index',
            component: PostIndex
        },
        {
            path: '/posts/create',
            name: 'posts.create',
            component: PostCreate
        },
        {
            path: '/posts/edit',
            name: 'post-edit',
            component: PostEdit
        },
    ]
});


import pagination from 'laravel-vue-pagination';

//window.Vue = require('vue').default;

//Vue.component('posts-index', require('./components/Posts/Index').default);
Vue.component('pagination', pagination);
Vue.component('pagination', require('laravel-vue-pagination'));


const app = new Vue({
    el: '#app',
    comments: {App},
    router
});
