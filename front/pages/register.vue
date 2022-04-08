<template lang="pug">
.register
  Bbh1(h1='新規会員登録')
  .container
    .error-message(v-if="errors !==''")
      el-alert(title="エラーメッセージ" type="error")
        .errors(v-for="error in errors")
          .error(v-for="errorData in error")
            p {{ errorData}}
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
      response: '',
      errors: '',
    }
  },
  methods: {
    async register() {
      this.$axios
        .post('http://127.0.0.1:8000/api/auth/register', this.form)
        .then((response) => {
          this.response = response
          this.$auth.loginWith('local', {
            data: this.form,
          })
        })
        .catch((error) => {
          this.errors = error.response.data
        })
    },
  },
}
</script>

<style lang="stylus">
.register
  .container
    width 50%
    margin 0 auto
    .error-message
      .errors
        .error
          p
            margin-top 5px
</style>
