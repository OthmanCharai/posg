<script setup lang="ts">
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import "sweetalert2/dist/sweetalert2.min.css";
import "@/src/assets/scss/main.scss";

const isLoading = ref(true);

function checkLoadStatus() {
  if (document.readyState === 'complete') {
    isLoading.value = false;
  } else {
    window.addEventListener('load', () => {
      isLoading.value = false;
    }, { once: true });
  }
}
checkLoadStatus();
</script>

<template>
  <div>
    <div class="main-wrapper">
      <Loader v-if="isLoading" :is-active="true" :has-overlay="false"/>
      <router-view v-if="!isLoading"/>
    </div>
  </div>
</template>
