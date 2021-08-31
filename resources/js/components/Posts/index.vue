<template>
<div>
    <select v-model="category_id" class="form-control col-md-3">
            <option value="">-- Choose Category --</option>
            <option v-for="category in categories"
                v-bind:key="category.id"
                :value="category.id"
            >
                {{ category.name }}
            </option>
    </select>
    <table class="table">
        <thead>
            <tr>
                <th>Names</th>
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
                posts:{},
                categories:{},
                category_id: ''
            }
        },
        mounted(){
            axios.get('/api/categories')
				.then(response => {
					this.categories = response.data.data
			}),
            this.getResults()
        },
        watch: {
            category_id(value) { this.getResults() }
        },
        methods: {
		getResults(page = 1) {
			axios.get('/api/posts?page=' + page + '&category_id=' + this.category_id)
				.then(response => {
					this.posts = response.data;
				});
		}
	}
    }

</script>
