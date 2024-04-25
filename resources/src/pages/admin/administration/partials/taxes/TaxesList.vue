<script setup lang="ts">
import type { Taxes } from '@common/types/taxes';
import CreateTaxe from './CreateTaxe.vue';
import EditTaxe from './EditTaxe.vue';
import { useTaxeStore } from '@stores/taxes.store';
import { lengthSorter } from '@/src/composables/table-sorters';
import CreateTaxeVariant from './taxe-variants/CreateTaxeVariant.vue';
import EditTaxeVariant from './taxe-variants/EditTaxeVariant.vue';

const store = useTaxeStore();
const columns = computed(() => [
  {
    title: "Taxes",
    dataIndex: "name",
    sorter: lengthSorter('name'),
  },
  {
    title: "Valeur",
    dataIndex: "value",
    sorter: lengthSorter('value'),
  },
  {
    title: "Type de valeur",
    dataIndex: "type",
    sorter: lengthSorter('type'),
  },
  {
    title: 'Action',
    key: 'action',
  },
]);

//----------- CRUD Taxes -----------------
const showCreateTaxeModal = ref(false);
provide('showCreateTaxeModal', showCreateTaxeModal);

const showUpdateTaxeModal = ref(false);
provide('showUpdateTaxeModal', showUpdateTaxeModal);

// Edit taxe
const editTaxe = (record: Taxes) => {
  store.setSelectedTaxe(record);
  showUpdateTaxeModal.value = true;
}

// Delete taxe
const showDeleteTaxeModal = ref<boolean>(false);
const deleteTaxe = (record: Taxes) => {
  store.setSelectedTaxe(record);
  showDeleteTaxeModal.value = true;
}

//----------- CRUD Taxe Variants -----------------
const showCreateTaxeVariantModal = ref(false);
provide('showCreateTaxeVariantModal', showCreateTaxeVariantModal);

const showUpdateTaxeVariantModal = ref(false);
provide('showUpdateTaxeVariantModal', showUpdateTaxeVariantModal);

// Create taxe variant
const createTaxeVariant = (id: string | undefined) => {
  store.setSelectedTaxeId(id);
  showCreateTaxeVariantModal.value = true;
}

// Edit taxe variant
const editTaxeVariant = (record: Taxes) => {
  store.setSelectedTaxe(record);
  showUpdateTaxeVariantModal.value = true;
}

// Delete taxe variant
const showDeleteTaxeVariantModal = ref<boolean>(false);
const deleteTaxeVariant = (record: Taxes) => {
  store.setSelectedTaxe(record);
  showDeleteTaxeVariantModal.value = true;
}

onMounted(async() => {
  await store.getTaxesList();
})
</script>

<template>
  <section class="mb-10">
    <div class="mb-10 flex justify-end">
      <a-button type="primary" @click="showCreateTaxeModal = true">
        <vue-feather :size="16" type="plus"></vue-feather>
        <span>Ajouter une taxe</span>
      </a-button>
    </div>
    <div v-if="store.taxesList.length > 0" class="grid gap-10">
      <div v-for="(item, i) in store.taxesList" :key="i" class="overflow-hidden bg-white shadow-md sm:rounded-lg max-h-[324px] !overflow-y-scroll">
        <div class="px-3 md:px-4 py-6 sm:px-6 flex justify-between">
          <div class="flex gap-2">
            <h3 class="text-base font-semibold leading-7 text-gray-900">
              {{ item.name }}
            </h3>
            <a-button type="default" size="middle" class="!p-1" @click="editTaxe(item)">
              <template #icon>
                <vue-feather type="edit" class="w-4"></vue-feather>
              </template>
            </a-button>
          </div>
          <a-button type="default" shape="circle" size="small" class="!py-1 !px-1 !w-[28px]" @click="deleteTaxe(item)">
            <template #icon>
              <vue-feather type="x" class="w-4"></vue-feather>
            </template>
          </a-button>
        </div>
        <div class="border-t border-gray-100 px-3 md:px-4 py-4 flex flex-col-reverse md:flex-row gap-2">
          <div class="w-full md:w-[90%] mx-auto">
            <DataTable
              :columns="columns"
              :data="store.taxesList[i].tax_variants"
              :fetched-data="store.getTaxesList"
              :loading="false"
            >
              <template #bodyCell="{column, record}">
                <template v-if="column.dataIndex === 'type'">
                  {{ record[column.dataIndex] === 0 ? '%' : '$' }}
                </template>

                <template v-if="column.key === 'action'">
                  <td class="action-table-data">
                    <button class="action-button edit" @click="editTaxeVariant(record)">
                      <vue-feather type="edit"></vue-feather>
                    </button>
                    <button class="action-button delete" @click="deleteTaxeVariant(record)">
                      <vue-feather type="trash-2"></vue-feather>
                    </button>
                  </td>
                </template>
              </template>
            </DataTable>
          </div>
          <div>
            <a-button type="default" @click="createTaxeVariant(item.id)">
              <vue-feather :size="16" type="plus"></vue-feather>
              <span>{{`Nouveau ${item.name}`}}</span>
            </a-button>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="flex justify-center items-center h-96">
      <a-empty />
    </div>
  </section>
  <!--------- Taxe parent CRUD modals ----------->
  <CreateTaxe v-if="showCreateTaxeModal" />
  <EditTaxe v-if="store.getResponse && showUpdateTaxeModal" />
  <DeleteAlert
    v-if="store.getResponse && showDeleteTaxeModal"
    v-model:toggle="showDeleteTaxeModal"
    model="tax"
    :id="store.selectedTaxe.id"
    :update-data="() => store.getTaxesList()"
  />

  <!--------- Taxe variants CRUD modals ----------->
  <CreateTaxeVariant v-if="showCreateTaxeVariantModal" />
  <EditTaxeVariant v-if="store.getResponse && showUpdateTaxeVariantModal" />
  <DeleteAlert
    v-if="store.getResponse && showDeleteTaxeVariantModal"
    v-model:toggle="showDeleteTaxeVariantModal"
    model="tax-variant"
    :id="store.selectedTaxe.id"
    :update-data="() => store.getTaxesList()"
  />
</template>

