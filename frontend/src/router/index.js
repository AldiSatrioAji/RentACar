import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Mobil from '@/components/Mobil'
import Pelanggan from '@/components/Pelanggan'
import Sewa from '@/components/Sewa'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Mobil',
      component: Mobil
    },
    {
      path: '/mobil',
      name: 'Mobil',
      component: Mobil
    },
    {
      path: '/pelanggan',
      name: 'Pelanggan',
      component: Pelanggan
    },
    {
      path: '/sewa',
      name: 'Sewa',
      component: Sewa
    }
  ]
})
