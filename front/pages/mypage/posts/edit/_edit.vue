<template lang="pug">
.posts-edit-page
  el-form(:model="response")
    el-input(type="hidden" v-model="response.content" name="content")
    el-form-item(label="タイトル")
      el-input(name="title" placeholder="タイトル" v-model="response.title")
    el-form-item(label="本文")
    .markdown-editor
      client-only
          mavon-editor(
              :toolbars="markdownOption"
              language="ja"
              v-model="response.content"
              @change="changeText"
          )
    el-form-item(label='')
    el-form-item(label="カテゴリ")
        el-input(placeholder="カテゴリを選択" v-model="response.tags")
    el-form-item(label='公開ステータス')
    el-radio-group(v-model="response.status")
        el-radio(label="0" v-model="response.status") 公開
        el-radio(label="1" v-model="response.status") 非公開
    el-form-item(label="")
    el-button(type="primary" icon="el-icon-upload el-icon-right" @click="onSubmit") 保存
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
            response: "",
            mdText: "",
            markdownOption: {
                bold: true,
                italic: true,
                header: true,
                underline: true,
                strikethrough: true,
                mark: true,
                quote: true,
                ol: true,
                ul: true,
                link: true,
                imagelink: true,
                code: true,
                table: true,
                fullscreen: true,
                htmlcode: true,
            },
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
        changeText(value, render) {
            this.mdText = value;
            this.response.content = render;
        },
        getPostsData() {
            console.log(this.$route.params.edit)
            this.$axios
                .get(this.$axios.defaults.baseURL + 'posts/' + this.$route.params.edit)
                .then((response) => {
                    this.response = response.data[0]
                })
        },
    }
}
</script>

<style lang="stylus">
</style>