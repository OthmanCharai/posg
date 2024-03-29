<script setup lang="ts">
</script>

<template>
  <layout-header></layout-header>
  <layout-sidebar></layout-sidebar>

  <Suspense>
    <router-view></router-view>
  </Suspense>
</template>



