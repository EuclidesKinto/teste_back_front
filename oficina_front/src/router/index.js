import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Budgets/HomeView.vue')
    },
    {
      path: '/vendedores',
      name: 'index-seller',
      component: () => import('../views/Sellers/IndexView.vue')
    },
    {
      path: '/vendedores/criar',
      name: 'create-seller',
      component: () => import('../views/Sellers/CreateView.vue')
    },
    {
      path: '/vendedores/:id/editar',
      name: 'edit-seller',
      props:true,
      component: () => import('../views/Sellers/EditView.vue')
    },
    {
      path: '/orcamentos/criar',
      name: 'create-budget',
      component: () => import('../views/Budgets/CreateView.vue')
    },
    {
      path: '/orcamentos/:id/editar',
      name: 'edit-budget',
      props:true,
      component: () => import('../views/Budgets/EditView.vue')
    }
  ]
})

export default router
