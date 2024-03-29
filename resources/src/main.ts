import { createApp } from "vue";
import { createPinia } from 'pinia';
import { router } from "@/src/router";
import VueSweetalert2 from "vue-sweetalert2";
import App from "./App.vue";

import "bootstrap/dist/css/bootstrap.min.css";
import "sweetalert2/dist/sweetalert2.min.css";
import "@/src/assets/scss/main.scss";
import "@/src/assets/css/style.css";


/********* Layout component**********/
import Header from "./views/layouts/posg-header.vue";
import Sidebar from "./views/layouts/posg-sidebar.vue";

const app = createApp(App);

/********* Layout component**********/
app.component("layout-header", Header);
app.component("layout-sidebar", Sidebar);

app.use(VueSweetalert2);
app.use(createPinia());
app.use(router).mount("#app");
