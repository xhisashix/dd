<template lang="pug">
div
  .login
    h1 ログインユーザー
    .login-container
      el-form(:model="form")
        el-form-item(label="メールアドレス")
          el-input(v-model="form.email")
        el-form-item(label="パスワード")
          el-input(v-model="form.password" type="password")
        el-button(type="primary" @click="login") ログイン
</template>
<script>
export default {
  middleware({ store, redirect }) {
    if (store.$auth.loggedIn) {
      redirect('/')
    }
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
    }
  },
  methods: {
    async login() {
      console.log('通化')
      try {
        await this.$auth.loginWith('local', {
          data: this.form,
        })
      } catch (error) {
        console.log(error)
      }
    },
  },
}
</script>
<style lang="stylus">
.login
  margin-top 30px
  h1
    font-size rem(30px)
  .login-container
    width 50%
    margin 0 auto
</style>
