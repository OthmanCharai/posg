<script lang="ts" setup>
import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
import { Modal } from 'ant-design-vue';
import { useAxios, route } from '@utils/axios-helper';
import { Toast } from '@utils/toast';
import { createVNode } from 'vue';

const { toggle, id, model, updateData } = defineProps({
  toggle: {
    type: Boolean,
    required: true,
  },
  id: {
    type: String,
    default: ''
  },
  model: {
    type: String,
    default: '',
  },
  updateData: {
    type: Function,
    required: true,
  }
});

const { request, response, loading } = useAxios();
const emit = defineEmits(['update:toggle']);

// Delete Request
async function deleteAction () {
  await request({
    method: 'DELETE',
    url: route(`${model}.delete`, id),
  });

  if(response.value){
    Toast.success('Votre suppression a été réussie');
    emit('update:toggle', false);
    updateData();
  }
};

// Popup Delete Alert
function showDeleteAlert() {
  Modal.confirm({
    title: 'Voulez-vous supprimer cet élément ?',
    icon: createVNode(ExclamationCircleOutlined),
    content: 'Si vous cliquez sur (Oui), vous ne le récupérerez pas',
    okText: 'Oui',
    okType: 'danger',
    cancelText: 'Non',
    wrapClassName: 'delete-alert-wrapper',
    width: 420,
    zIndex: 1010,
    async onOk() {
      try {
        return await deleteAction();
      } catch(e) {
        return console.error('Oops errors! :', e);
      }
    },
    onCancel() {
      emit('update:toggle', false);
    },
  });
}

if (toggle === true) {
  showDeleteAlert();
}
</script>

<template>
  <Loader :is-active="loading"/>
</template>
