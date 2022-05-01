<template lang="pug">
.page-create-category
  .error-section(v-if="errors")
    .error
      el-alert(:title="errors" type="error" show-icon)
  el-form(:v-model="form")
    el-form-item(label="カテゴリ名")
      el-input(v-model="form.category_name" name="category_name")
    el-input(type="hidden" v-model="form.user_id = user.id" name="user_id")
    el-button(type="primary" icon="el-icon-upload el-icon-right" @click="saveCategory") 保存
</template>

<script>
export default {
    layout: 'mypage',
    data() {
        return {
            form: {
                user_id: "",
                category_name: '',
            },
            errors: "",
        }
    },
    computed: {
        user() {
            return this.$auth.user;
        },
    },
    methods: {
        saveCategory() {
            this.$axios
                .post(this.$axios.defaults.baseURL + "categories/create", this.form)
                .then((response) => {
                    this.$router.push('/mypage/category/compleat')
                })
                .catch((error) => {
                    this.errors = error.response.data.error
                })
        }
    },
}
</script>

<style lang="stylus">
  
</style>