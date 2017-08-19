<template>
  <div id="app" class="page-home">
    <header id="site-header" class="site-header">
      <nav>
        <ul>
          <router-link tag="li" to="/" exact><a href="">Home</a></router-link>
          <!-- <router-link v-for="link in navLinks" tag="li" to="/" exact><a href="" v-text="link.linkText"></a></router-link> -->
          <router-link to="/blog" exact>Blog</router-link>
        </ul>
      </nav>
    </header>
    <transition name="fade">
      <router-view></router-view>
    </transition>
    <footer class="footer">
      <div class="inner page-container">
        <div class="left">
          <div class="logo">
            <img src="https://cdn.kastatic.org/images/large-tree-transparent.png" alt="Logo">
          </div>
          <div class="social">
            <ul>
              <li><a href="#0">F</a></li>
              <li><a href="#0">T</a></li>
              <li><a href="#0">I</a></li>
            </ul>
          </div>
        </div> <!-- LEFT -->
        <div class="right">
          <div class="column">
            <h3 class="underline">Categories</h3>
            <ul>
              <li><a href="#0">Health</a></li>
              <li><a href="#0">Lifestyle</a></li>
              <li><a href="#0">Recipes</a></li>
              <li><a href="#0">Travel</a></li>
              <li><a href="#0">News</a></li>
            </ul>
          </div>
          <div class="column">
            <h3 class="underline">Explore Satya Kitchen</h3>
            <ul>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Recipes</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
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
