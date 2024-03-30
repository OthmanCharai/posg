import { createApp } from "vue";
import { createPinia } from 'pinia';
import { router } from "@/src/router";
import VueSweetalert2 from "vue-sweetalert2";
import VueFeather from "vue-feather";
import.meta.glob(['@/src/assets/img/logo/favicon.ico']);
import App from "./App.vue";

import "bootstrap/dist/css/bootstrap.min.css";
import "sweetalert2/dist/sweetalert2.min.css";
import "@/src/assets/scss/main.scss";

const app = createApp(App);

app.component(VueFeather.name, VueFeather);

app.use(VueSweetalert2);
app.use(createPinia());
app.use(router).mount("#app");
