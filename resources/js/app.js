console.log( 'configured' )


import Vue from 'vue'
import Echo from "laravel-echo"
import axios from 'axios'
import App from './App.vue'

window.Pusher = require('pusher-js');

console.log( 'pusher', window.Pusher )

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

Vue.config.productionTip = false
Vue.prototype.$http = axios

console.log( 'variables', window.Pusher )
console.log('pusher variables', process.env.MIX_PUSHER_APP_KEY, process.env.MIX_PUSHER_APP_CLUSTER)

new Vue({
    render: h => h(App)
  }).$mount('#app')