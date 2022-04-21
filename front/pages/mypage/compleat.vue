<template lang="pug">
.page-edit-compleat
  el-result(icon="success" title="プロフィールの編集が完了しました。" subTitle="サイド編集する場合はマイページへ戻るを押してください。")
      template(slot="extra")
        .link-area
          nuxt-link(to="/")
            el-button(plain) TOPへ戻る
          nuxt-link(to="/mypage")
            el-button(plain) マイページへ戻る
</template>

<script>
export default {}
</script>

<style lang="stylus">
.page-edit-compleat
  max-width: 980px
  margin 0 auto
  .link-area
    display: flex
    justify-content: center
    align-items: center
    a
      margin-right: 20px
</style>