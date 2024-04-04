<script setup lang="ts">
  defineProps<{
    title?: string;
  }>()
</script>

<template>
  <div class="page-header">
    <div class="add-item d-flex">
      <div class="page-title">
        <h3>{{ title }}</h3>
      </div>
    </div>
    <slot />
  </div>
</template>
