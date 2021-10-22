<template lang="pug">
.register
  .container
    .error(v-if="response")
      div(v-if="response.data.status == 'error'")
        ul
          //- li(v-for="massage in response.data.message" :key="massage.id")
          li
            p {{ response.data.messages.email }}
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
    }
  },
  methods: {
    async register() {
      this.$axios
        .post('http://localhost:8888/api/v1/register', this.form)
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
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
</style>
