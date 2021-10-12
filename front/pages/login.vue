<template lang="pug">
#p-login
  .p-login__wrapper
    .p-login__content
      .p-login__card
        form(@submit.prevent='login')
          .p-login__card--body
            .p-login__error(v-if='auth.error') メールアドレスまたはパスワードが違います。
            .c-form__row.p-login__form--group
              input.c-form__control.p-login__form--control(type='text' placeholder='メールアドレス' name='email' v-model='auth.email')
            .c-form__row.p-login__form--group
              input.c-form__control.p-login__form--control(type='password' placeholder='パスワード' name='password' v-model='auth.password')
            .c-form__row.p-login__form--group.p-login__form--submit
              button.c-button__reset.c-button__primary.c-button__block.c-button__submit(v-bind:disabled='processing')
                span ログイン
            .p-login__form--supply
              | パスワードを忘れた方は
              n-link(to='/password/forgot' v-bind:disabled='processing') こちら
            .c-form__row.p-login__form--group.p-login__form--register
              n-link.btn.btn-secondary.btn-submit.btn-block.p-reset__form--btn.c-auth__button(to='/register' v-bind:disabled='processing') 新規会員登録
</template>
<script>
export default {
  middleware: ['auth'],
  layout: 'login',
  head() {
    return {
      title: 'ログイン',
    }
  },
  data() {
    return {
      processing: false,
      auth: {
        email: '',
        password: '',
        error: false,
      },
    }
  },
  methods: {
    async login() {
      this.auth.error = false
      this.processing = true
      try {
        await this.$auth.loginWith('User', { data: this.auth }).then(() => {
          this.processing = false
        })
      } catch (err) {
        console.log(err)
        this.auth.error = true
        this.processing = false
      }
    },
  },
}
</script>
<style lang="stylus">
.login
  h1
    font-size rem(30px)
</style>
