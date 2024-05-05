<script setup lang="ts">
  const props = defineProps({
    open: Boolean,
    title: String,
    width: String,
  });

  const emit = defineEmits(['update:open', 'submit']);

  const internalOpen = ref(props.open);

  watch(
    () => props.open,
    (newVal) => {
      internalOpen.value = newVal;
    },
  );

  watch(internalOpen, (newVal) => {
    emit('update:open', newVal);
  });
</script>

<template>
  <a-modal
    v-model:open="internalOpen"
    :title="title"
    :zIndex="1010"
    :footer="null"
    :width="width"
  >
    <form @submit.prevent="$emit('submit')">
      <slot />
      <div class="mt-3 pt-3 flex justify-end gap-3 border-t">
        <a-button htmlType="submit" type="primary">
          <vue-feather :size="16" type="save" />
          <span>Enregister</span>
        </a-button>
        <a-button @click="internalOpen = false">
          <vue-feather :size="16" type="x-octagon" />
          <span>Annuler</span>
        </a-button>
      </div>
    </form>
  </a-modal>
</template>
