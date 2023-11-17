<template>
  <q-page padding class="bg-grey-4">
    <!-- content -->
    <div class="fullscreen flex flex-center">
      <q-form
        greedy
        @submit.prevent="handleLogin"
        class="column q-gutter-y-sm"
        style="width: 25%">
      <span class="text-h5 text-weight-light">Login</span>
        <q-input
          label="Username"
          standout="bg-teal-9 text-grey-1"
          padding="5px 25px"
          v-model="form.username"
          lazy-rules
          :rules="[
            val => val && val.length > 0 || 'Enter your username'
          ]"
        />
        <q-input
          label="Password"
          standout="bg-teal-9 text-grey-1"
          padding="5px 25px"
          :type="isPwd ? 'text' : 'password'"
          v-model="form.password"
           lazy-rules
          :rules="[
            val => val && val.length > 0 || 'Enter your username'
          ]"
        >
          <template v-slot:append>
            <q-icon :name="isPwd ? 'mdi-eye-outline' : 'mdi-eye-off-outline'" @click="isPwd = !isPwd" />
          </template>
        </q-input>
        <div class="row justify-between">
          <q-btn
            label="login"
            class="self-start"
            type="submit"
            color="teal"
          />
          <q-btn
            label="register"
            flat
            dense
            to="/auth/register"
          />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import { defineComponent, ref } from 'vue'
import { pythonApi } from 'boot/axios';
import { useRouter } from 'vue-router';
import { Notify } from 'quasar';
import { useUserStore } from 'stores/user-store';

defineComponent({
  name: 'LoginPage'
});

const router = useRouter();

const form = ref({
  username: '',
  password: ''
});
const isPwd = ref(false)
const userStore = useUserStore();

const handleLogin = async () => {
  try {
    const response = await pythonApi.post('/login', form.value);
    if (response.data.status === 401) {
      Notify.create({
        message: response.data.message,
        timeout: 2300,
        position: 'top-right',
        type: 'negative'
      });
    } else {
      userStore.initUser(response.data.token);
      router.push('/')
    }

  } catch (error) {
    throw error;
  }
}
</script>
