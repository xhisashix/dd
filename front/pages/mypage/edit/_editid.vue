<template lang="pug">
.page-edit
  Bbh1(h1='会員情報編集画面')
  .edit
    el-form(:model="user")
      el-form-item(label="名前")
        el-input(v-model="user.name")
      el-form-item(label="メールアドレス")
        el-input(v-model="user.email")
      el-form-item(label="パスワード")
        el-input(v-model="user.password" type="password")
      el-form-item(label="もう一度パスワードを入力してください")
        el-input(v-model="user.password_confirmation" type="password")
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
<style lang="stylus"></style>
