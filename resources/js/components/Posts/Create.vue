<template>
<div>
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

    <div class="container">
      <form @submit.prevent="submit_form">
          Post Title
          <br>
          <input type="text" v-model="fields.title" class="form-control" />
          <br>
          Post Text 
         <br>
         <textarea rows="10" v-model="fields.post_text" class="form-control"></textarea>
         <br>
         Category 
         <select class="form-control" v-model="fields.category_id">
            <option v-for="category in categories"
                v-bind:key="category.id"
                :value="category.id"
                >
                {{ category.name }}
            </option>

         </select>
         <br>
         <input type="submit" class="btm btn-primary" value="Save Post" />
         <br>
         <p></p>
      </form>
  </div>
</div>

</template>

<script>
export default {
    data(){
        return{
            categories:{},
            fields: {
                title: '',
                post_text: '',
                category_id: '',
            }
            }
        },
        mounted(){
            axios.get('/api/categories')
				.then(response => {
					this.categories = response.data.data
			})
        },
        methods: {
            submit_form(){
                axios.post('/api/posts', this.fields)
				.then(response => {
					this.$router.push('/')
			})
            }
        }
}
</script>

