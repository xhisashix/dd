<template lang="pug">
.my-page-side
  ul
    li
      nuxt-link(to='/mypage/') マイページ
    li
      nuxt-link(to='/mypage/posts/') 記事作成
    li
      nuxt-link(to='/mypage/posts/list') 記事一覧
    li
      nuxt-link(to='/mypage/category/') カテゴリ登録
    li
      nuxt-link(to='/mypage/category/list/') カテゴリ一覧
</template>

<script>
export default {

}
</script>

<style lang="stylus">
.my-page-side
  margin-right: 30px
  ul
    box-sizing: border-box
    li
      margin-top: 20px
      border-bottom: 1px solid #eee
      padding-bottom 10px
      a
        font-size rem(18px)
</style>