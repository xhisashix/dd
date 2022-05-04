<template lang="pug">
  .container
    h1 記事一覧
    ul.content-list
      li(v-for="(item, index) in response")
        nuxt-link(:to="'/post/content/' + item.id")
          span.tag(v-if="item.name") {{ item.name }}
          h2 {{item.title }}
</template>

<script>
export default {
  data() {
    return {
      response: '',
    }
  },
  mounted() {
    this.getPostsData()
  },
  methods: {
    getPostsData() {
      this.$axios
        .get(this.$axios.defaults.baseURL + 'posts/published/0')
        .then((response) => {
          this.response = response.data.data
        })
    }
  },
}
</script>

<style lang="stylus">
.container
  padding-bottom 50px
  h1
    font-size rem(24px)
    line-height: rem(32px)
    padding-left 10px
    border-left: 3px solid #409EFF
  .content-list
    margin-top: 30px
    li
      a
        display: flex
        align-items: center
        margin-top 20px
        span
          margin-left: 15px
          &:first-child
            margin-left: 0
        .tag
          padding 5px 8px
          background: #409EFF
          color: color-white
          border-radius: 5px
          margin-right: 10px
</style>