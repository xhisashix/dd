<template lang="pug">
.my-page
  Bbh1(h1='マイページ')
  .content
    .btn-area
      nuxt-link(:to="'/mypage/edit/'+user.id")
        el-button(type="primary" icon="el-icon-edit") 編集
    table
      tbody
        tr
          th 会員番号
          td {{ user.id }}
        tr
          th 名前
          td {{ user.name }}
        tr
          th メールアドレス
          td {{ user.email }}
        tr
          th 登録日
          td {{ user.created_at | format-date }}
        tr
          th 更新日
          td {{ user.updated_at | format-date }}
  .my-posts-area
    Bbh1(h1='記事一覧')
    el-table(:data="response" style="width: 100%")
      el-table-column(prop="title" label="タイトル" width="180")
      el-table-column(prop="tags" label="カテゴリ" width="100")
      el-table-column(prop="content" label="本文")
      el-table-column(prop="updated_at" label="最終更新日" width="180")
      el-table-column(prop="" label="" width="100")
        el-button(type="primary" icon="el-icon-edit") 編集
</template>

<script>
export default {
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
.my-page
  .content
    table
      width 100%
      margin-top: 20px
      tbody
        tr
          border-bottom: 1px solid #eee
          th
            width 20%
            padding 15px 10px
          td
            width 80%
    .btn-area
      display: flex
      justify-content: flex-end
      align-items: center
      margin-top: 30px
  .my-posts-area
    margin-top 30px
</style>
