i
<script setup lang="ts">
  import { useBankAccountStore } from '@stores/bankAccount.store';
  import { BankAccount } from '@common/types/global/bankAccount';
  import CreateBank from '@pages/admin/bankAccount/CreateBank.vue';
  import UpdateBank from '@pages/admin/bankAccount/UpdateBank.vue';

  const store = useBankAccountStore();
  const columns = computed(() => [
    {
      title: 'Nom de la banque',
      dataIndex: 'bank_name',
      sorter: true,
    },
    {
      title: 'Numéro de compte',
      dataIndex: 'account_number',
      sorter: true,
    },
    {
      title: 'Solde',
      dataIndex: 'balance',
      sorter: true,
    },
    {
      title: 'Nom du titulaire',
      dataIndex: 'account_holder_name',
      sorter: true,
    },
    {
      title: 'Téléphone du titulaire',
      dataIndex: 'account_holder_phone',
      sorter: true,
    },
    {
      title: 'Email du titulaire',
      dataIndex: 'account_holder_email',
      sorter: true,
    },
    {
      title: 'Action',
      key: 'action',
    },
  ]);

  const showCreateModal = ref(false);
  provide('showCreateModal', showCreateModal);

  const showUpdateModal = ref(false);
  provide('showUpdateModal', showUpdateModal);

  // Edit user
  const editBankAccount = (record: BankAccount) => {
    store.setCurrentData(record);
    showUpdateModal.value = true;
  };

  // Delete user
  const showDeleteAlert = ref<boolean>(false);
  const deleteBankAccount = (record: BankAccount) => {
    store.setCurrentData(record);
    showDeleteAlert.value = true;
  };

  onMounted(async () => {
    await store.getList();
  });
</script>

<template>
  <PageHeader>
    <a-button type="primary" @click="showCreateModal = true">
      <vue-feather :size="16" type="plus-circle"></vue-feather>
      <span>Ajouter</span>
    </a-button>
  </PageHeader>

  <div class="card table-list-card">
    <Filter />
    <div class="card-body">
      <DataTable
        :columns="columns"
        :data="store.bankAccounts"
        :current-page="store.pagination.current_page"
        :total="store.pagination.total"
        :fetched-data="store.getList"
        :loading="store.loading"
      >
        <template #bodyCell="{ column, record }">
          <template v-if="column.key === 'action'">
            <td class="action-table-data">
              <button class="action-button edit" @click="editBankAccount(record)">
                <vue-feather type="edit"></vue-feather>
              </button>
              <button class="action-button delete" @click="deleteBankAccount(record)">
                <vue-feather type="trash-2"></vue-feather>
              </button>
            </td>
          </template>
        </template>
      </DataTable>
    </div>
  </div>
  <!-- Create Banques modal -->
  <CreateBank v-if="store.getResponse && showCreateModal" />
  <!-- Update Banques modal -->
  <UpdateBank v-if="store.getResponse && showUpdateModal" />
  <!-- Delte Banques Alert -->
  <DeleteAlert
    v-if="store.getResponse && showDeleteAlert"
    v-model:toggle="showDeleteAlert"
    model="bank-accounts"
    :id="store.currentBankAccount.id"
  />
</template>
