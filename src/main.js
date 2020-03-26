import Vue from 'vue';
import App from './App.vue';
import vuetify from './plugins/vuetify';
import router from './routes';
import {store} from './store';
import dateFilter from './filters/date.js';
import Alert from './components/Shared/Alert.vue';
import RegisterDialog from './components/Shared/RegisterDialog.vue';
Vue.component('app-alert',Alert);
Vue.component('delete-dialog',RegisterDialog);

Vue.filter('date',dateFilter)
Vue.config.productionTip = false
new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')