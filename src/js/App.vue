<template>
  <div id="app">
    <header id="site-header">
      <nav>
        <ul>
          <router-link tag="li" to="/" exact><a href="">Home</a></router-link>
          <router-link v-for="link in navLinks" tag="li" to="/" exact><a href="" v-text="link.linkText"></a></router-link>
        </ul>
      </nav>
    </header>
    <!-- <router-link to="/" exact>Home</router-link> -->
    <!-- <router-link to="/blog" exact>Blog</router-link> -->
    <router-view></router-view>
  </div>
</template>

<script>

export default {
  data() {
    return {
      navLinks : []
    }
  },

  created() {
    axios.get('/api/header.json')
         .then(response => this.navLinks = response.data.data[0].headerLinks);
  },

};

</script>
