import { defineStore } from 'pinia'
import IAdmin from '../pages/admins/type'
import { useAxios } from '../utils/axios-helper'

const { request, response, loading, errorMessage } = useAxios()
export const useAdmins = defineStore('admins', {
  state: () => {
    return { 
        admins: Array<IAdmin>
     }
  },

  actions: {
    const get=async()=>{
        await request({
            method: 'GET',
            url: route('admins.index')
        });
        if(response){
            this.admins=response;
        }
    },
  },
})