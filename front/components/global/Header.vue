<template lang="pug">
.header
  header
    .logo
    .btn-area
      a(href="/login")
        el-button(type='primary' v-if="!this.$auth.loggedIn") ログイン
      el-button(type='info' v-if="this.$auth.loggedIn" @click='logout') ログアウト
      a(href="/register")
      el-button(type='default') 新規登録
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
