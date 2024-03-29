<script setup lang="ts">
  import { RouterView } from 'vue-router';
  import Header from './partials/Header.vue';
  import Sidebar from './partials/Sidebar.vue';
</script>

<template>
  <Header />
  <Sidebar />

  <Suspense>
    <RouterView />
  </Suspense>
</template>
