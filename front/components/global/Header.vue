<template lang="pug">
.header
  header
    .logo
    .btn-area
      button(type='submit') ログイン
      button(type='submit') 新規登録
</template>
<script>
export default {}
</script>
<style lang="stylus">
.header
  border-bottom 2px solid #eee
  header
    min-height 50px
    display flex
    height 100%
    align-items center
    .logo
      width 200px
    .btn-area
      margin-left auto
      display flex
      align-items center
</style>
