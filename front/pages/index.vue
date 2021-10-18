<template lang='pug'>
  .container
    p 名前：{{ user.name }}
    p 年齢：{{ user.email }}
    el-button.button(type="info" @click="logout") ログアウト
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
  methods: {
    logout() {
      this.$auth.logout();
    },
  }
}
</script>
