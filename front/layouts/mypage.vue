<template lang="pug">
.layout-my-page
  Header
  .main-content
    .side-menu
      MypageSide
    .main
      Nuxt
  Footer
</template>

<script>
export default {

}
</script>

<style lang="stylus">
.layout-my-page
  .main-content
    display: flex
    .side-menu
      width: 200px
    .main
      width: 100%
</style>