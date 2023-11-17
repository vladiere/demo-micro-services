<template>
  <q-item
    v-ripple
    :class="status === 'done' ? 'bg-green-5' : ''"
  >
    <q-item-section avatar>
      <q-icon color="primary" name="mdi-delete-outline" class="cursor-pointer" @click="handleDelete(id)"/>
    </q-item-section>
    <q-item-section v-if="status === 'undone'" avatar>
      <q-icon color="green-9" name="mdi-check-all" class="cursor-pointer" @click="handleStatus(id)"/>
    </q-item-section>
    <q-item-section>
      <q-item-label>{{ wordFormatter(list_name) }}</q-item-label>
      <q-item-label caption lines="2">{{ wordFormatter(list_desc) }}</q-item-label>
    </q-item-section>

    <q-item-section side top>
      <q-item-label caption>{{ formatdate(created_at) }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script setup lang="ts">
  import { format, date, Notify } from 'quasar';
  import { laravelApi } from 'boot/axios';
  import { useListStore } from 'stores/list-store';


  export interface ListProps {
    id: number;
    list_name: string | null;
    list_desc: string | null;
    status: string | null;
    created_at: string | unknown;
  }

  withDefaults(defineProps<ListProps>(), {
    id: null,
    list_name: '',
    list_desc: '',
    created_at: '',
    status: ''
  });

  const listStore = useListStore();

  const wordFormatter = (word: string) => {
    return format.capitalize(word);
  }

  const formatdate = (currentDate: string) => {
    return date.formatDate(currentDate, 'MMM-D-YYYY')
  }

  const handleDelete = async (list_id: number) => {
    try {
      listStore.deleteList(list_id);
      const response = await laravelApi.post('/task/delete', { id: list_id });
      if (response.status === 200) {
        Notify.create({
          message: response.data.message,
          position: 'top-right',
          type: 'positive',
          timeout: 2300
        })
      }
    } catch (error) {
      throw error;
    }
  }

  const handleStatus = async (list_id: number) => {
    try {
      listStore.markDone(list_id)
      const response = await laravelApi.post('/task/done', { id: list_id });
      if (response.status === 200) {
        Notify.create({
          message: response.data.message,
          position: 'top-right',
          type: 'positive',
          timeout: 2300
        })
      }
    } catch (error) {
      throw error;
    }
  }
</script>
