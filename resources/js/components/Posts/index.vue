<template>
<div class="container">
        <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Laravel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link active-class="active-menu" exact :to="{ name:'posts.index' }" class="nav-link">Posts</router-link>
                            <!-- <router-link to="/posts" class="nav-link">Posts</router-link> -->
                        </li>
                        <li class="nav-item">
                            <!-- <router-link to="/posts/create" class="nav-link">Add new post</router-link> -->
                            <router-link active-class="active-menu" exact :to="{ name:'posts.create' }" class="nav-link">Add new pos</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4 container">
            <router-view/>
        </main>
    </div>
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
                <th>
                    <a href="#" @click.prevent="change_sort('title')">Title</a>
                    <span v-if="this.sort_field == 'title' && this.sort_direction == 'asc'">&uarr;</span>
                    <span v-if="this.sort_field == 'title' && this.sort_direction == 'desc'">&darr;</span> 
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('post_text')">Post Text</a>
                    <span v-if="this.sort_field == 'post_text' && this.sort_direction == 'asc'">&uarr;</span>
                    <span v-if="this.sort_field == 'post_text' && this.sort_direction == 'desc'">&darr;</span> 
                </th>
                <th>
                    <a href="#" @click.prevent="change_sort('created_at')">Created Date</a>
                    <span v-if="this.sort_field == 'created_at' && this.sort_direction == 'asc'">&uarr;</span>
                    <span v-if="this.sort_field == 'created_at' && this.sort_direction == 'desc'">&darr;</span> 
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="post in posts.data" v-bind:key="post.id">
                <td>{{ post.title }}</td>
                <td>{{ post.post_text.substring(0,35) }}</td>
                <td>{{ post.created_at }}</td>
                <td>
                    <router-link :to="{name:'posts.edit', params:{ id: post.id}}">
                            Edit
                    </router-link>
                </td>
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
                category_id: '',
                sort_field: 'created_at',
                sort_direction: 'desc',
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
        change_sort(field){
            console.log('change sort worked')
            if(this.sort_field === field) {
                this.sort_direction = this.sort_direction === 'asc' ? 'desc': 'asc'
            } else {
                this.sort_field = field
                this.sort_direction = 'asc'
            }
            this.sort_field = field
            this.getResults()
        },
		getResults(page = 1) {
			axios.get('/api/posts?page=' + page 
            + '&category_id=' + this.category_id
            + '&sort_field=' + this.sort_field
            + '&sort_direction=' + this.sort_direction
            )
				.then(response => {
					this.posts = response.data;
				});
		}
	}
    }

</script>

