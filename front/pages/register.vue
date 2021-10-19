<template lang="pug">
.register
  .container
    el-form(:model="form")
      el-form-item(label="名前")
        el-input(v-model="form.name")
      el-form-item(label="メールアドレス")
        el-input(v-model="form.email")
      el-form-item(label="パスワード")
        el-input(v-model="form.password" type="password")
      el-form-item(label="もう一度パスワードを入力してください")
        el-input(v-model="form.password_confirmation" type="password")
      el-button.btn.btn-primary(type='success' @click='register') 新規登録
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
    }
  },
  methods: {
    register() {
      this.$axios
        .post('http://localhost:8888/api/auth/register', this.form)
        .then((response) => {
          this.$auth.loginWith('local', {
            data: this.form,
          })
        })
        setTimeout(this.$router.replace({ path: '/mypage' }), 3000);
    },
  },
}
</script>

<style lang="stylus">
.register
  .container
    width 50%
    margin 0 auto
</style>
