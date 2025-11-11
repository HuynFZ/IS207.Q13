import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Admin from '../pages/Admin.vue'

import ProductCatalog from '../pages/ProductCatalog.vue' // Trang Danh mục Sản phẩm
import OrderManagement from '../pages/OrderManagement.vue' // Trang Quản lý Đơn hàng
import ProductDetail from '../pages/ProductDetail.vue';
const routes = [
    {
        path: '/',
        redirect: '/home'
    },
    {
        path: '/home',
        name: 'Home',
        component: Home
    },
    {
        path: '/admin',
        name: 'Admin',
        component: Admin
    },
    {
        path: '/products',
        name: 'ProductCatalog',
        component: ProductCatalog
    },
    {
        path: '/orders',
        name: 'OrderManagement',
        component: OrderManagement
    },
    {
        path: '/product/:id', // ":id" là một tham số động
        name: 'ProductDetail', // Đặt tên cho route
        component: ProductDetail // Component sẽ hiển thị
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
