import { defineStore } from 'pinia';
import { ListProps } from 'components/ListComponent.vue';

export const useListStore = defineStore('list', {
  state: () => ({
    list: [] as Array<ListProps>
  }),

  getters: {
    getAllList (state) {
      return state.list;
    }
  },

  actions: {
    listInit (list: unknown) {
      this.list = list;
    },
    deleteList (list_id: number) {
      const index = this.list.findIndex((item: any) => item.id === list_id);
      if (index !== -1) {
        this.list.splice(index, 1);
      }
    },
    markDone (list_id: number) {
      const index = this.list.findIndex((item: any) => item.id === list_id);
      if (index !== -1) {
        this.list[index].status = 'done';
      }

    }
  }
});
