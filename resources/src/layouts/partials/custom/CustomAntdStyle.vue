<script setup lang="ts">
  import { customStyle } from './helper';
</script>

<template>
  <a-config-provider :theme="customStyle">
    <a-app />
  </a-config-provider>
</template>
