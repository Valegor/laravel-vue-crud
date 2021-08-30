<template>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Post</th>
                <th>Created date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="post in posts" v-bind:key="post.id">
                <td>{{ post.title }}</td>
                <td>{{ post.post_text.substring(0,35) }}</td>
                <td>{{ post.created_at }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default{
        data(){
            return{
                posts:[]
            }
        },
        mounted(){
            axios.get('/api/posts').then(response =>{
                this.posts = response.data.data
            })
        }
    }

</script>
