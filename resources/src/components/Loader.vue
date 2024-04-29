<script setup lang="ts">
const props = withDefaults(defineProps<{
  isActive: boolean
  hasOverlay?: boolean
}>(), {
  isActive: false,
  hasOverlay: true,
})

const backgroundColor = ref('');

onMounted(() => {
  backgroundColor.value = props.hasOverlay ? 'rgba(0, 0, 0, 0.2)' : 'unset';
})
</script>

<template>
  <div v-if="isActive" class="custom-ant-loader">
    <a-spin size="large" />
  </div>
</template>

<style scoped>
.custom-ant-loader {
  width: 100%;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  background-color: v-bind(backgroundColor);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}
</style>
