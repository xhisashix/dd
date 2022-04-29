<template lang="pug">
.page-posts-list
  .my-posts-area
    Bbh1(h1='記事一覧')
    table
      tbody
        tr
          th タイトル
          th カテゴリ
          th 本文
          th 最終更新日
          th
        tr(v-for="item in response" :key="item.id")
          td(v-html="item.title")
          td(v-html="item.name")
          td(v-html="item.content.slice(0, 100)")
          td(v-html="item.updated_at")
          td
            nuxt-link(:to="'/mypage/posts/edit/' + item.id")
              el-button(type="primary" icon="el-icon-edit") 編集
</template>
<script>
export default {
  layout: 'mypage',
  middleware({ store, redirect }) {
        if (!store.$auth.loggedIn) {
            redirect('/login')
        }
    },
    data() {
        return {
            path: '/mypage/edit/',
            response: "",
        }
    },
    computed: {
        user() {
            return this.$auth.user
        },
    },
    mounted() {
      this.getPostsData()
    },
    methods: {
        getPostsData() {
            this.$axios
                .get(this.$axios.defaults.baseURL + 'posts/user_id/' + this.user.id)
                .then((response) => {
                    this.response = response.data
                })
        },
    }
}
</script>
<style lang="stylus">
.page-posts-list
  .my-posts-area
    margin-top 30px
    table
      width: 100%
      tr
        border: 1px solid #eee
      th,td
        min-width: 150px
        border-left: 1px solid #eee
        padding 10px
        vertical-align: middle
        max-width: 300px;
        height: 50px
        overflow: hidden;
</style>