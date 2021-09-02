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
          <div class="alert alert-danger" v-if="errors && errors.title" >
              {{ this.errors.title[0] }}
          </div>
            
            errors
          <br>
          Post Text 
         <br>
          <div class="alert alert-danger" v-if="errors && errors.post_text" >
              {{ this.errors.post_text[0] }}
          </div>
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
         <div class="alert alert-danger" v-if="errors && errors.category_id" >
              {{ this.errors.category_id[0] }}
          </div>
          <br>
          Thumbnail:
          <br>
          <input type="file" @change="select_file">
          <br><br>
         <br>
         <input type="submit" 
                :disabled="form_submitting" 
                class="btm btn-primary" 
                :value="form_submitting ? 'Saving post' : 'Save post'">
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
                thumbnail: null,
            },
            errors:{},
            form_submitting: false
            }
        },
        mounted(){
            axios.get('/api/categories')
				.then(response => {
					this.categories = response.data.data
			})
        },
        methods: {
            select_file(event){
                this.fields.thumbnail = event.target.files[0]
            },
            submit_form(){
                console.log('submit')
                this.form_submitting = true

                let fields = new FormData()
                for(let key in this.fields) {
                    fields.append(key, this.fields[key])
                }


                axios.post('/api/posts', fields)
				.then(response => {
					this.$router.push('/')
                    this.form_submitting = false
			}).catch( error => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors
                    console.log(this.errors.category_id[0])
                    this.form_submitting = false
                }
            })
            }
        }
}
</script>

