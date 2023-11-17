<template>
  <q-page padding>
      <div class="column items-center q-gutter-y-md">
        <div class="row q-gutter-x-lg">
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
          <q-btn
              icon="mdi-plus-box-outline"
              flat
              dense
              color="teal"
              @click="prompt = !prompt"
            >
            <q-tooltip class="bg-grey-10 text-grey-1" :delay="250">
              Add new list
            </q-tooltip>
          </q-btn>
        </div>
        <q-virtual-scroll
          style="max-height: calc(100vh - 152px)"
          :items="lists"
          separator
          v-slot="{ item, index }"
        >
          <ListComponent :key="index" v-bind="item" />
        </q-virtual-scroll>
      </div>
    <q-dialog v-model="prompt" persistent>
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Add new list</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <span class="text-subtitle1">List name</span>
          <q-input dense v-model="list.list_name" autofocus @keyup.enter="handleAddList" />
          <span class="text-subtitle1">List description</span>
          <q-input dense v-model="list.list_desc" autogrow @keyup.enter="handleAddList" />
        </q-card-section>

        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancel" v-close-popup />
          <q-btn flat label="Add"  @click="handleAddList" />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script setup lang="ts">
import { defineComponent, defineAsyncComponent, ref, computed, onMounted } from 'vue';
import { useListStore } from 'stores/list-store';
import { useUserStore } from 'stores/user-store';
import { jwtDecode } from 'jwt-decode';
import { tsApi } from 'boot/axios';
import { Notify } from 'quasar';

defineComponent({
  name: 'IndexPage'
});

const ListComponent = defineAsyncComponent({
  loader: () => import('components/ListComponent.vue'),
  delay: 1000,
  suspensible: false,
  timeout: 2300,
});

const listStore = useListStore();
const userStore = useUserStore();
const search = ref('');
const lists = computed(() => listStore.getAllList);
const prompt = ref(false);
const decoded = jwtDecode(userStore.token);

const list = ref({
  user_id: decoded.sub.user_id,
  list_name: '',
  list_desc: ''
});


const handleAddList = async () => {
  try {
    let current_id = 0;

    if (list.value.length > 0) {
      current_id = lists.value[lists.value.length - 1].id;
    }

    const response = await tsApi.post('/list/create', list.value)
    if (response.data.status === 201) {
      Notify.create({
        message: response.data.message,
        position: 'top-right',
        type: 'positive',
        timeout: 2300
      });

      prompt.value = false;

      lists.value.push({
        id: current_id + 1,
        user_id: decoded.sub.user_id,
        list_name: list.value.list_name,
        list_desc: list.value.list_desc,
        status: 'undone',
        created_at: Date.now(),
      });
      list.value.list_name = '';
      list.value.list_desc = '';
    }
  } catch (error) {
    throw error;
  }
}

const getUserList = async () => {
  try {
    const response = await tsApi.post('/list/get', { user_id: decoded.sub.user_id });
    listStore.listInit(response.data);
  } catch (error) {
    throw error;
  }
}

onMounted(async() => {
  await getUserList();
})
</script>
