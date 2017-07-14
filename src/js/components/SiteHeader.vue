<template>
  <nav>
    <ul>
      <router-link tag="l" to="/" exact>Home</router-link>
      <router-link tag="l" to="/blog" exact>Blog</router-link>
    </ul>
  </nav>
</template>


<script>
export default {
  name: 'header'
};

</script>
