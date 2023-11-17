<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-grey-4 text-grey-10">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="https://picsum.photos/id/119/1200/800">
          </q-avatar>
          Demo Todo List
        </q-toolbar-title>
        <q-space />
        <q-btn
          label="Logout"
          no-caps
          dense
          flat
          @click="handleLogout"
        />
      </q-toolbar>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useUserStore } from 'stores/user-store';
import { useRouter } from 'vue-router';

const userStore = useUserStore();
const router = useRouter();

const handleLogout = () => {
  userStore.clearUser();
  router.push('/auth')
}
</script>
