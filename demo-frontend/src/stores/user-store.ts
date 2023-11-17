import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    authenticated: false,
    token: '',
  }),

  getters: {
    isAuthenticated (state) {
      return state.authenticated;
    }
  },

  actions: {
    initUser (tokens: string) {
      this.token = tokens;
      this.authenticated = true;
    },
    clearUser () {
      this.refreshToken = '';
      this.token = '';
      this.authenticated = false;
    }
  },
  persist: {
    storage: sessionStorage
  }
});
