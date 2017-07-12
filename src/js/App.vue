<template>
  <div id="app">
    <h1>{{ welcomeMessage }}</h1>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      welcomeMessage: 'Hello World'
    }
  }
}
</script>
