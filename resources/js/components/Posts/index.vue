<template>
<div>
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
            <tr v-for="post in posts.data" v-bind:key="post.id">
                <td>{{ post.title }}</td>
                <td>{{ post.post_text.substring(0,35) }}</td>
                <td>{{ post.created_at }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <pagination :data="posts" @pagination-change-page="getResults"></pagination>
</div>
</template>

<script>
    export default{
        data(){
            return{
                posts:{}
            }
        },
        mounted(){
            console.log (this.getResults())
            // axios.get('/api/posts').then(response =>{
            //     this.posts = response.data.data
            // })
        },
        methods: {
		getResults(page = 1) {
			axios.get('/api/posts?page=' + page)
				.then(response => {
					this.posts = response.data;
				});
		}
	}
    }

</script>
