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
          td {{ user.created_at }}
        tr
          th 更新日
          td {{ user.updated_at }}
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
    }
  },
  computed: {
    user() {
      return this.$auth.user
    },
  },
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
</style>
