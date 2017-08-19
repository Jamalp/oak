<template>
  <div :html="rawHtml"></div>
</template>

<script>

module.exports = {
   props: ['post'],
   data() {
     return {
       rawHtml: this.post
     }
   },

  created: function () {
    console.log('user data from parent component:')
    console.log(this.post) //prints out an empty string
  },


}

</script>
