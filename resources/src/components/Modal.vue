<script setup lang="ts">
defineProps<{
  id: string
}>();
</script>

<template>
  <div
    class="modal fade"
    :id="id"
    tabindex="-1"
    role="dialog"
    aria-labelledby="myLargeModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">
            <slot name="title"></slot>
          </h4>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
          </button>
        </div>
        <div class="modal-body">
          <slot name="body"></slot>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">
            <vue-feather :size="16" type="save"></vue-feather>
            <span>Enregister</span>
          </button>
          <button
            type="button"
            class="btn btn-light"
            data-bs-dismiss="modal"
          >
            <vue-feather :size="16" type="x-octagon"></vue-feather>
            <span>Annuler</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
