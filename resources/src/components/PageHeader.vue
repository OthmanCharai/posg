<script setup lang="ts">
  defineProps<{
    title?: string;
  }>();
</script>

<template>
  <div class="flex flex-col gap-2 md:flex-row md:justify-between md:items-center mb-5">
    <h3>{{ title }}</h3>
    <div class="flex justify-between">
      <span></span>
      <slot />
    </div>
  </div>
</template>
