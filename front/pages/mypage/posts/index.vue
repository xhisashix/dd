<template lang="pug">
.page-new-post
    .error-section(v-if="errors")
        .error
            el-alert(:title="errors" type="error" show-icon v-if="errors")
    el-form(:model="postItem")
        el-input(type="hidden" v-model="postItem.content" name="content")
        el-input(type="hidden" v-model="postItem.user_id=user.id" name="user_id")
        el-form-item(label="タイトル")
        el-input(name="title" placeholder="タイトル" v-model="postItem.title")
        el-form-item(label="本文")
        .markdown-editor
            client-only
                mavon-editor(
                    :toolbars="markdownOption"
                    language="ja"
                    v-model="mdText"
                    @change="changeText"
                )
        el-form-item(label='')
        el-form-item(label="カテゴリ")
            el-select(placeholder="カテゴリを選択" v-model="value")
                el-option(
                    v-for="category in postItem.category"
                    :label="category.name"
                    :value="category.id"
                    name="categories_id"
                )
        el-form-item(label='公開ステータス')
        el-radio-group(v-model="postItem.status")
            el-radio(:label="0") 公開
            el-radio(:label="1") 非公開
        el-form-item(label="")
        el-button(type="primary" icon="el-icon-upload el-icon-right" @click="onSubmit") 保存
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
            model: "",
            response: "",
            mdText: "",
            errors: '',
            value: '',
            postItem: {
                user_id: "",
                title: "",
                content: "投稿テスト",
                category: '',
                status: 0,
            },
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
        };
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
        changeText(value, render) {
            this.mdText = value;
            this.postItem.content = render;
        },
        async onSubmit() {
            try {
                await this.$axios
                    .post(this.$axios.defaults.baseURL + "posts/create/", this.postItem).then((response) => {
                        this.response = response.data;
                        this.$router.push('/mypage/posts/compleat')
                    });
            } catch (error) {
                (error);
                this.error = error;
            }
        },
        getCategory() {
            this.$axios
                .get(this.$axios.defaults.baseURL + 'categories/user_id/' + this.user.id)
                .then((response) => {
                    this.postItem.category = response.data.data
                })
        }
    },
};
</script>

<style scoped>
.markdown-editor {
    width: 100%;
    height: 100%;
}
</style>
