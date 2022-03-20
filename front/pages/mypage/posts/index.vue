<template lang="pug">
.page-new-post
  el-form(:model="postItem")
    el-form-item(label="タイトル")
      el-input(name="title" placeholder="タイトル")
    el-form-item(label="本文")
    .markdown-editor
      client-only
        mavon-editor(:toolbars="markdownOption" language="ja" v-model="model")
</template>

<script>
export default {
    data() {
        return {
            model: "",
            postItem: {
              title : "",
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
};
</script>

<style scoped>
.markdown-editor {
    width: 100%;
    height: 100%;
}
</style>