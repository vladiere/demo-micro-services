<template>
  <q-page padding>
      <div class="column items-center q-gutter-y-md">
        <q-input
          placeholder="Search list"
          outlined
          rounded
          dense
          v-model="search"
        >
          <template v-slot:append>
            <q-icon name="mdi-magnify" />
          </template>
        </q-input>
        <q-virtual-scroll
          style="max-height: calc(100% - 90px)"
          :items="lists"
          separator
          v-slot="{ item, index }"
        >
          <ListComponent :key="index" v-bind="item" />
        </q-virtual-scroll>
      </div>
  </q-page>
</template>

<script setup lang="ts">
import { defineComponent, defineAsyncComponent, ref } from 'vue';
import { ListProps } from 'components/ListComponent.vue';

defineComponent({
  name: 'IndexPage'
});

const ListComponent = defineAsyncComponent({
  loader: () => import('components/ListComponent.vue'),
  delay: 300,
  suspensible: false,
  timeout: 2300,
});

const search = ref('');
const lists = ref<ListProps>([]);
</script>
