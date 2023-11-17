import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/auth',
    meta: { auth: false },
    component: () => import('layouts/LoginLayout.vue'),
    children: [
      { path: '', component: () => import('pages/LoginPage.vue') },
      { path: 'register', component: () => import('pages/RegisterPage.vue') },
    ],
  },
  {
    path: '/',
    meta: { auth: true },
    component: () => import('layouts/MainLayout.vue'),
    children: [
      {
        path: '',
        meta: { auth: true },
        component: () => import('pages/IndexPage.vue')
      },
    ]
  },
   // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
