<template lang="pug">
.page-category-edit
  .error-section(v-if="errors")
    .error
      el-alert(:title="errors" type="error" show-icon)
  el-form(:v-model="categories")
    el-form-item(label="カテゴリ名")
      el-input(v-model="categories.name" name="category_name")
    el-button(type="primary" icon="el-icon-upload el-icon-right" @click="saveCategory") 保存
</template>

<script>
export default {
    layout: 'mypage',
    data() {
        return {
            errors: "",
            categories: "",
        }
    },
    computed: {
        user() {
            return this.$auth.user;
        },
    },
    mounted() {
        this.getCategory()
    },
    methods: {
        saveCategory() {
            this.$axios
                .post(this.$axios.defaults.baseURL + "categories/edit", this.categories)
                .then((response) => {
                    this.$router.push('/mypage/category/compleat')
                })
                .catch((error) => {
                    this.errors = error.response.data.error
                })
        },
        getCategory() {
            this.$axios
                .get(this.$axios.defaults.baseURL + 'categories/' + this.$route.params.edit)
                .then((response) => {
                    this.categories = response.data.data
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