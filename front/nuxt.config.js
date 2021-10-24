export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'front',
    htmlAttrs: {
      lang: 'ja',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ['./assets/stylus/setcss.styl'],

  styleResources: {
    stylus: './assets/stylus/set.styl',
  },

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ['~/plugins/element.js'],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: {
    dirs: [
      '~/components',
      '~/components/ui/'
    ]
  },

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
    '@nuxtjs/moment'
  ],

  moment: {
    locales: ['ja']
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: ['@nuxtjs/style-resources', '@nuxtjs/axios', '@nuxtjs/auth'],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    baseURL: 'http://localhost:8888/api/auth', // apiのベースURLを追加
  },
  auth: {
    redirect: {
      login: '/login', // 未ログイン時に認証ルートへアクセスした際のリダイレクトURL
      logout: '/login', // ログアウト時のリダイレクトURL
      callback: false, // Oauth認証等で必要となる コールバックルート
      home: '/', // ログイン後のリダイレクトURL
    },
    localStorage: false, // JWTトークンをローカルストレージに入れておくのは危ない
    strategies: {
      local: {
        tokenType:'bearer',
        endpoints: {
          token: {
            property: 'access_token',
          },
          login: {
            url: 'http://localhost:8888/api/auth/login',
            method: 'post',
            propertyName: 'access_token',
          },
          user: {
            url: 'http://localhost:8888/api/auth/me',
            method: 'get',
            propertyName: false,
          },
          logout: false,
        },
      },
    },
  },

  // router: {
  //   middleware: ['auth']
  // },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},
}
