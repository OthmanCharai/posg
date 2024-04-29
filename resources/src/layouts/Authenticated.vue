<script setup lang="ts">
  import { RouterView } from 'vue-router';
  import Header from './partials/Header.vue';
  import Sidebar from './partials/Sidebar.vue';
  import CustomAntdStyle from './partials/custom/CustomAntdStyle.vue';
</script>

<template>
  <CustomAntdStyle />
  <Header />
  <Sidebar />

  <section class="page-wrapper">
    <div class="content">
      <RouterView />
    </div>
  </section>
</template>
