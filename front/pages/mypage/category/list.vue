<template lang="pug">
.page-category-list
  table
    tbody
      tr
        th ID
        th カテゴリ名
        th
      tr(v-for="category in categories" :key="category.id")
        td.cat-id(v-html="category.id")
        td.cat-name(v-html="category.name")
        td
          nuxt-link(:to="'/mypage/category/edit/' + category.id")
            el-button(type="primary" icon="el-icon-edit") 編集
</template>

<script>
export default {
    layout: 'mypage',
    middleware({ store, redirect }) {
        if (!store.$auth.loggedIn) {
            redirect("/login");
        }
    },
    data() {
        return {
            categories: '',
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
        getCategory() {
            this.$axios
                .get(this.$axios.defaults.baseURL + 'categories/user_id/' + this.user.id)
                .then((response) => {
                    this.categories = response.data.data
                })
        }
    },
}
</script>

<style lang="stylus">
.page-category-list
  margin-top: 30px
  table
    width: 100%
    tr
      border: 1px solid #eee
    th,td
      min-width: 100px
      border-left: 1px solid #eee
      padding 10px
      vertical-align: middle
      max-width: 300px;
      height: 50px
      overflow: hidden;
    .cat-id
      width 100px
      text-align center
    .cat-name
      width: 100%
</style>