<template>
  <section class="blog-post">
    <div class="hero" v-bind:style="{ 'background-image': 'url(' + post.heroImage + ')' }">
      <div class="overlay"></div>
      <header class="hero-copy">
        <h1>{{ post.title }}</h1>
        <p>{{ post.subtitle }}</p>
      </header>
    </div>
    <article class="blog-content">

      <template v-for="content in post.body">
        <template v-if="content.paragraph">
          <div class="paragraph" v-html="content.paragraph"></div>
        </template>
        <template v-if="content.fullBleedImage">
          <img v-bind:src="content.fullBleedImage" alt="">
        </template>
        <template v-if="content.singleImage">
          <img v-bind:src="content.singleImage" alt="">
        </template>
        <template v-if="content.imageRow">
          <div class="image-row" v-bind:class="{  }">
            <div class="image" v-for="image in content.imageRow">
              <img :src="image" alt="">
            </div>
          </div>
        </template>
        <template v-if="content.recipe">
          <aside class="recipe">
            <div class="recipe-image">
              <img v-bind:src="content.recipe.image" alt="">
            </div>
            <div class="recipe-details">
              <div v-html="content.recipe.ingredients"></div>
              <div v-html="content.recipe.instructions"></div>
            </div>
          </aside>
        </template>
      </template>
    </article>
  </section>
</template>

<script>
  import PostParagraph from '../components/PostParagraph.vue';
  export default {
    name: 'blogpost',
    data () {
      return {
        post: []
      }
    },
    mounted() {
      this.getPost();
    },
    methods: {
      getPost() {
        let vm = this;
        let slug = this.$route.params.slug;

        axios.get('/api/blog/'+ slug +'.json')
             .then(response => {
               this.post = response.data
             });
      }
    },
    components: {
      'post-paragraph':PostParagraph
    }
  }
</script>
