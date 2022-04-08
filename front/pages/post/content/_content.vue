<template lang="pug">
.page-post-content
  Bbh1(:h1='postData.title')
  .content
    div(v-html="postData.content")
</template>

<script>
export default {
    data() {
        return {
            postData: '',
        }
    },
    mounted() {
        this.getPostsData()
    },
    methods: {
        getPostsData() {
            this.$axios
                .get(this.$axios.defaults.baseURL + 'posts/' + this.$route.params.content)
                .then((response) => {
                    this.postData = response.data[0]
                })
        },
    },
}
</script>

<style lang="stylus">
.page-post-content
  padding 50px 0 80px
  .content
    h1
      font-size rem(32px)
      line-height rem(42px)
      margin-top 30px
      margin-bottom 30px
      font-weight bold
    h2
      font-size rem(28px)
      line-height rem(36px)
      margin 30px 0
      font-weight bold
    h3
      font-size rem(24px)
      line-height rem(32px)
    h4
      font-size rem(22px)
      line-height rem(28px)
    h5
      font-size rem(20px)
      line-height rem(26px)
    p
      font-size rem(16px)
      line-height rem(24px)
    ol
      padding-left 25px
      box-sizing border-box
      margin 20px 0
      li
        margin-top 15px
        list-style decimal
</style>