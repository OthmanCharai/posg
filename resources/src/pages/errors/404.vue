<script setup lang="ts">
import { Result } from 'ant-design-vue';
</script>

<template>
  <div class="wrong-page-wrapper">
    <Result status="404" title="404" sub-title="Désolé, la page que vous avez visitée n'existe pas.">
      <template #extra>
        <a
          href="/"
          class="btn btn-primary"
          >
          Retour à l'accueil
        </a>
      </template>
    </Result>
  </div>
</template>

<style scoped>
  .wrong-page-wrapper {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
