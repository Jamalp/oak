<template>
  <section class="blog">
  	<div class="hero" style="background:url(https://images.unsplash.com/photo-1465125792985-0dd0cf761dca?dpr=1&auto=format&fit=crop&w=1500&h=901&q=80&cs=tinysrgb&crop=) center center no-repeat;background-size:cover;">
      <div class="overlay"></div>
      <header>
        <h1>The Blog</h1>
        <p>Stories &amp; recipes from our kitchen</p>
      </header>
    </div>

    <section class="blog-list page-container page-wrapper">
      <div class="wrapper">
        <div class="blog-post tile" v-for="entry in posts" :key="entry.id">
          <router-link :to="{ name: 'blogPost', params : { slug: entry.slug }}" class="image">
            <img v-bind:src="entry.image[0]" alt="">
          </router-link>
          <div class="blog-post-title">
            <a :href="'blog/' + entry.slug">{{ entry.title }}</a>
          </div>
        </div>
      </div>
    </section>
	</section>
</template>

<script>
export default {
  name: 'bloglist',
  data () {
    return {
      posts: []
    }
  },
  mounted() {
    this.getEntries();
  },
  methods: {
    getEntries() {
      let vm = this;

      axios.get('api/blog.json')
           .then(response => {
             this.posts = response.data.data
           });
    }
  }
}
</script>
