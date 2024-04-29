import { createApp } from "vue";
import { createPinia } from 'pinia';
import { router } from "@/src/router";
import { BootstrapVue3, BToastPlugin } from "bootstrap-vue-3";
import VueSweetalert2 from "vue-sweetalert2";
import VueFeather from "vue-feather";
import.meta.glob(['@/src/assets/img/logo/favicon.ico']);
import App from "./App.vue";

const app = createApp(App);
app.component(VueFeather.name, VueFeather);

app.use(VueSweetalert2);
app.use(createPinia());
app
  .use(BootstrapVue3)
  .use(BToastPlugin);
app.use(router).mount("#app");
