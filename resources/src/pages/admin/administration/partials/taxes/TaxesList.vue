<script setup lang="ts">
import type { Taxes } from '@common/types/taxes';
import CreateTaxe from './CreateTaxe.vue';
import EditTaxe from './EditTaxe.vue';
import { useTaxeStore } from '@stores/taxes.store';

const store = useTaxeStore();
const showCreateTaxeModal = ref(false);
provide('showCreateTaxeModal', showCreateTaxeModal);

const showUpdateTaxeModal = ref(false);
provide('showUpdateTaxeModal', showUpdateTaxeModal);

// Edit user
const editUser = (record: Taxes) => {
  store.setSelectedTaxe(record);
  showUpdateTaxeModal.value = true;
}

// Delete user
const showDeleteTaxeModal = ref<boolean>(false);
const deleteUser = (record: Taxes) => {
  store.setSelectedTaxe(record);
  showDeleteTaxeModal.value = true;
}
</script>

<template>
  <div class="mb-10 flex justify-end">
    <a-button type="primary" @click="showCreateTaxeModal = true">
      <vue-feather :size="16" type="plus"></vue-feather>
      <span>Ajouter une taxe</span>
    </a-button>
  </div>
  <div v-if="true" class="overflow-hidden bg-white shadow-md sm:rounded-lg">
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
  <div v-else class="flex justify-center items-center h-96">
    <a-empty />
  </div>

  <!-- Create taxe modal -->
  <CreateTaxe v-if="showCreateTaxeModal" />
  <!-- Update taxe modal -->
  <EditTaxe v-if="store.getResponse && showUpdateTaxeModal" />
  <!-- Delte taxe Alert -->
  <DeleteAlert
    v-if="store.getResponse && showDeleteTaxeModal"
    v-model:toggle="showDeleteTaxeModal"
    model="tax"
    :id="store.selectedTaxe.id"
    :update-data="() => store.getTaxesList()"
  />
</template>

