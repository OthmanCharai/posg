<script setup lang="ts">
  import { PerfectScrollbar } from 'vue3-perfect-scrollbar';
  import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css';
  import UserMenu from './UserMenu.vue';

  const settings = {
    suppressScrollX: true,
  };

  const scrollHandle: () => void = () => {};
</script>

<template>
  <div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <PerfectScrollbar
        class="scroll-area"
        :settings="settings"
        @ps-scroll-y="scrollHandle()"
      >
        <div id="sidebar-menu" class="sidebar-menu">
          <UserMenu />
        </div>
      </PerfectScrollbar>
    </div>
  </div>
  <collapsed-sidebar />
</template>
