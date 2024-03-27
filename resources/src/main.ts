import { createApp } from "vue";
import { router } from "@/src/router";
import App from "./App.vue";
import VueSweetalert2 from "vue-sweetalert2";

import "sweetalert2/dist/sweetalert2.min.css";

export const route = window.route;

const app = createApp(App);

app.use(VueSweetalert2);
app.use(router).mount("#app");
