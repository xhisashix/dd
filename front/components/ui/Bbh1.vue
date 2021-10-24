<template lang="pug">
  h1.h1(v-html="h1")
</template>
<script>
export default {
  props: {
    h1: {
      default: '',
      type: String,
    },
  },
}
</script>
<style lang="stylus">
.h1
  border-left: 3px solid #409EFF
  font-size rem(20px)
  line-height: rem(28px)
  padding-left 10px
  font-weight bold
  margin 20px 0
</style>
