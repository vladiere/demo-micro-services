<template>
  <q-item>
    <q-item-section>
      <q-item-label>{{ wordFormatter(list_name) }}</q-item-label>
      <q-item-label caption lines="2">{{ wordFormatter(list_desc) }}</q-item-label>
    </q-item-section>

    <q-item-section side top>
      <q-item-label caption>{{ created_at }}</q-item-label>
    </q-item-section>
  </q-item>
</template>

<script lang="ts">
  import { format } from 'quasar';

  export interface ListProps {
    list_name: string;
    list_desc: string;
    created_at: string;
    updated_at: string;
  }

  withDefaults(defineProps<ListProps>(), {
    list_name: '',
    list_desc: '',
    created_at: '',
    updated_at: ''
  });

  const wordFormatter = (word: string) => {
    return format.capitalize(word);
  }
</script>
