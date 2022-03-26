<template lang="pug">
.posts-edit-page
  table
    tbody
      tr
        th タイトル
        th カテゴリ
        th 本文
        th 最終更新日
        th
      tr(v-for="item in response" :key="item.id")
        td(v-html="item.title")
        td(v-html="item.tags")
        td(v-html="item.content")
        td(v-html="item.updated_at")
        td
          nuxt-link(:to="'/mypage/posts/edit/' + item.id")
            el-button(type="primary" icon="el-icon-edit") 編集
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
            response: "",
        }
    },
    computed: {
        user() {
            return this.$auth.user
        },
    },
    mounted() {
      this.getPostsData()
    },
    methods: {
        getPostsData() {
            console.log(this.$route.params.edit)
            this.$axios
                .get(this.$axios.defaults.baseURL + 'posts/'+ this.$route.params.edit)
                .then((response) => {
                    this.response = response.data
                })
        },
    }
}
</script>
<style lang="stylus">
</style>