<template>
  <q-page padding class="bg-grey-4">
    <!-- content -->
    <div class="fullscreen flex flex-center">
      <q-form
        greedy
        class="column q-gutter-y-sm"
        style="width: 25%"
        @submit.prevent="handleRegister"
      >
        <span class="text-h5 text-weight-light">Register</span>
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
            label="register"
            class="self-start"
            type="submit"
            color="teal"
          />
          <q-btn
            label="login"
            flat
            dense
            to="/auth"
          />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import { defineComponent, ref } from 'vue'
import { pythonApi } from 'src/boot/axios';
import { Notify } from 'quasar';
import { useRouter } from 'vue-router';

defineComponent({
  name: 'RegisterPage'
});

const form = ref({
  username: '',
  password: ''
});
const isPwd = ref(false);
const router = useRouter()


const handleRegister = async () => {
  try {
    const response = await pythonApi.post('/register', form.value);
    if (response.data.status === 201) {
      Notify.create({
        message: response.data.message,
        type: 'positive',
        timeout: 2300,
        position: 'top-right'
      })
      router.push('/auth')
    }
  } catch (error) {
    throw error;
  }
}
</script>
