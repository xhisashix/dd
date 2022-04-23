<template lang="pug">
.header
  header
    .logo
      nuxt-link(to='/')
        el-button(type='default') TOP
    .btn-area
      nuxt-link(to="/login" v-if="!this.$auth.loggedIn")
        el-button(type='primary') ログイン
      el-button(type='info' v-if="this.$auth.loggedIn" @click='logout') ログアウト
      nuxt-link(to="/register" v-if="!this.$auth.loggedIn")
        el-button(type='default') 新規登録
      nuxt-link(to="/mypage" v-if="this.$auth.loggedIn")
        el-button(type='primary') マイページ
      nuxt-link(to="/mypage/posts/" v-if="this.$auth.loggedIn")
        el-button 記事作成
</template>

<script>
export default {
    methods: {
        logout() {
            this.$auth.logout();
        },
    }
}
</script>

<style lang="stylus">
.header
  border-bottom 2px solid #eee
  padding 10px 20px
  box-sizing: border-box
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
      margin-right: 20px
      a
        margin 0 5px
</style>
