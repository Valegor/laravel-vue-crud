
import App from "../components/App.vue";
import PostIndex from "../components/Posts/Index.vue";
import PostCreate from "../components/Posts/Create.vue";
import PostEdit from "../components/Posts/Edit.vue";

export default {
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
}
