<template lang="pug">
.page-edit
  Bbh1(h1='会員情報編集画面')
  .error-section(v-if="errors")
    .error
      el-alert(:title="errors.name[0]" type="error" show-icon v-if="errors.name")
    .error
      el-alert(:title="errors.email[0]" type="error" show-icon v-if="errors.email")
    .error
      el-alert(:title="errors.password[0]" type="error" show-icon v-if="errors.password")
  .edit
    el-form(:model="response")
      el-input(v-model="this.$route.params.edit" type="hidden")
      el-form-item(label="名前")
        el-input(v-model="response.name")
      el-form-item(label="メールアドレス")
        el-input(v-model="response.email")
      el-form-item(label="パスワード")
        el-input(v-model="response.password" type="password")
      el-form-item(label="もう一度パスワードを入力してください")
        el-input(v-model="response.password_confirmation" type="password")
      el-button(type="primary" icon="el-icon-upload el-icon-right" @click="saveUserData") 保存
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
            response: {
                password: '',
                password_confirmation: '',
            },
            errors: '',
        }
    },
    mounted() {
        this.getUser()
    },
    methods: {
        getUser() {
            this.$axios
                .get(this.$axios.defaults.baseURL + 'auth/me/')
                .then((response) => {
                    this.response = response.data
                })
        },
        saveUserData() {
            this.$axios
                .post(this.$axios.defaults.baseURL + "auth/edit/", this.response)
                .then((response) => {
                    console.log(response)
                })
                .catch((error) => {
                    this.errors = error.response.data
                })
        }
    },
}
</script>

<style lang="stylus">
.page-edit
  .error-section
    .error
      margin-top 8px
</style>
