<template lang="pug">
.my-page
  Bbh1(h1='マイページ')
  .content
    table
      tbody
        tr
          th 名前
          td {{ user.name }}
        tr
          th メールアドレス
          td {{ user.email }}
        tr
          th 登録日
          td {{ user.created_at }}
</template>
<script>
export default {
  middleware({ store, redirect }) {
    if(!store.$auth.loggedIn) {
      redirect('/login');
    }
  },
  computed: {
    user() {
      return this.$auth.user;
    }
  },
}
</script>
<style lang="stylus">
.my-page
  .content
    table
      tbody
        tr
          border-bottom: 1px solid #eee
          th, td
            width 200px
            padding 10px 10px
</style>
