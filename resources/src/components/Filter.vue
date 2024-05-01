<script setup lang="ts">
const filter = ref(false);
</script>

<template>
  <div class="table-top">
    <!-- Search input -->
    <div class="search-set">
      <div class="search-input">
        <input type="text" placeholder="Search" class="dark-input" />
        <a href="javascript:void(0);" class="btn btn-searchset">
          <vue-feather type="search" size="16" class="mr-[6px] mt-[7px]"></vue-feather>
        </a>
      </div>
    </div>
    <!-- /Search input -->
    <!-- Filter button -->
    <div class="search-path">
      <a id="filter_search" @click="filter = !filter">
        Recherche avancée »
      </a>
    </div>
    <!-- /Filter button -->
  </div>
  <!-- /Filter -->
  <div class="card mb-0" :style="{ display: filter ? 'block' : 'none' }" id="filter_inputs">
    <div class="card-body pb-0">
      <slot />
    </div>
  </div>
  <!-- /Filter -->
</template>
