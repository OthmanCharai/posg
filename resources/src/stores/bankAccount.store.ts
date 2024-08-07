import { defineStore } from 'pinia';
import type { PaginationMetadata } from '@common/types/global/pagination';
import type { BankAccount } from '@common/types/global/bankAccount';
import { route, useAxios } from '@utils/axios-helper';
import { extractPaginatorObject } from '@utils/pagination';

const { request, response, loading } = useAxios();

export const useBankAccountStore = defineStore('bankAccounts', {
  state: () => ({
    bankAccounts: [] as BankAccount[],
    pagination: {} as PaginationMetadata,
    loading: loading,
    getResponse: false,
    currentBankAccount: {} as BankAccount,
  }),
  actions: {
    async getList(page: number = 1) {
      await request({
        method: 'GET',
        url: route('bank-accounts.index', `page=${page}`),
      });
      try {
        if (response.value && response.value?.data) {
          this.bankAccounts = response.value?.data.bank_accounts.data;
          this.pagination = extractPaginatorObject(response.value?.data.bank_accounts);
          this.getResponse = true;
        }
      } catch (e) {
        console.error(e);
      }
    },

    async create(data: any) {
      await request({
        method: 'POST',
        url: route('bank-accounts.submit'),
        data: data,
      });
      try {
        if (response.value) {
          await this.getList();
        }
      } catch (e) {
        console.log(e);
      }
    },

    async update(bankAccount: BankAccount, data: any) {
      await request({
        method: 'PUT',
        url: route('bank-accounts.update', bankAccount.id),
        data: data,
      });
      try {
        if (response.value) {
          await this.getList();
        }
      } catch (e) {
        console.log(e);
      }
    },

    async delete(bankAccount: BankAccount) {
      await request({
        method: 'DELETE',
        url: route('bank-accounts.delete', bankAccount.id),
      });
      try {
        if (response.value) {
          await this.getList();
        }
      } catch (e) {
        console.log(e);
      }
    },

    setCurrentData(data: BankAccount) {
      this.currentBankAccount = data;
    },
  },
});
