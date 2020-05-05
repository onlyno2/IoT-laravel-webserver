require("../bootstrap");

import "core-js/stable";
import Vue from "vue";
import App from "./App";
import router from "./router";
import CoreuiVue, { CLink } from "@coreui/vue";
import { iconsSet as icons } from "./assets/icons/icons.js";
import store from "./store";
import axios from "axios";
import VueCookies from "vue-cookies";
var mqtt = require('mqtt');

var settings = {
  mqttServerUrl: '192.168.2.74',
  port: 18833
}

var client = mqtt.connect('mqtt://' + settings.mqttServerUrl + ":" + settings.port, { clientId: 'dashboard' });

Vue.config.performance = true;
Vue.use(CoreuiVue);
Vue.use(VueCookies);
Vue.prototype.$log = console.log.bind(console);
Vue.prototype.$http = axios;
Vue.prototype.$mqtt = client;

new Vue({
  el: "#app",
  router,
  store,
  icons,
  template: "<App/>",
  components: {
    App
  }
});
