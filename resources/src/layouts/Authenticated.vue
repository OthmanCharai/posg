<script setup lang="ts">
  import { RouterView } from 'vue-router';
</script>

<template>
  <layout-header></layout-header>
  <layout-sidebar></layout-sidebar>

  <Suspense>
    <RouterView />
  </Suspense>
</template>
