<script setup lang="ts">
</script>

<template>
  <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
    <div class="px-4 py-6 sm:px-6 flex justify-between">
      <div class="flex gap-2">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Applicant Information</h3>
        <a-button type="default" size="middle" class="!p-1">
          <template #icon>
            <vue-feather type="edit" class="w-4"></vue-feather>
          </template>
        </a-button>
      </div>
      <a-button type="default" shape="circle" size="small" class="!py-1 !px-1 !w-[28px]">
        <template #icon>
          <vue-feather type="x" class="w-4"></vue-feather>
        </template>
      </a-button>
    </div>
    <div class="border-t border-gray-100 p-4">
      <DataTable
        :columns="[]"
        :data="[]"
        :fetched-data="{}"
        :loading="false"
      >
        <template #bodyCell="{column, record}">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
</template>

