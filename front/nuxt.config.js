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
  plugins: [
    {src: '~/plugins/element.js'},
    {src: '~/plugins/format-date.js'},
    {src: '~/plugins/mavon-editor.js'}
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: {
    dirs: ['~/components', '~/components/ui/'],
  },

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/tailwindcss
    '@nuxtjs/tailwindcss',
    '@nuxtjs/moment',
  ],

  moment: {
    locales: ['ja'],
  },

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: ['@nuxtjs/style-resources', '@nuxtjs/axios', '@nuxtjs/auth'],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    //baseURL: ENV.API_BASE_URL,
    //browserBaseURL: 'http://localhost:3000/',
    prefix: process.env.API_BASE_URL,
    proxy: true
  },

  proxy: {
    '/api/': {
      target: 'http://127.0.0.1:8000',
      pathRewrite: {'^/api/': '/'}
    },
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
        tokenType: 'bearer',
        endpoints: {
          token: {
            property: 'access_token',
          },
          login: {
            url: 'http://127.0.0.1:8000/api/auth/login',
            method: 'post',
            propertyName: 'access_token',
          },
          user: {
            url: 'http://127.0.0.1:8000/api/auth/me',
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
