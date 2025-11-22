import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Admin from '../pages/Admin.vue'
import Login from '../pages/Login.vue'
import Profile from '../pages/Profile.vue'
import SocialProfile from '../pages/SocialProfile.vue'
import Forgot from '../pages/Forgot.vue'
import Register from '../pages/Register.vue'

import ProductCatalog from '../pages/ProductCatalog.vue' // Trang Danh mục Sản phẩm
import OrderManagement from '../pages/OrderManagement.vue' // Trang Quản lý Đơn hàng
import ProductDetail from '../pages/ProductDetail.vue';
import CreatePost from '../pages/CreatePost.vue';
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
        component: Admin,
        meta: { requiresAdmin: true }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/profile',
        name: 'Profile',
        component: Profile
    },
    {
        path: '/profile/social',
        name: 'SocialProfile',
        component: SocialProfile
    },
    {
        path: '/forgot',
        name: 'Forgot',
        component: Forgot
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
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
    },
    {
        path: '/post',
        name: 'CreatePost',
        component: CreatePost
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Global guard: protect admin route
import { useAuth } from '../utils/useAuth'

router.beforeEach((to, from, next) => {
    const { isLoggedIn, user } = useAuth()
    if (to.meta && to.meta.requiresAdmin) {
        if (isLoggedIn.value && user.value && user.value.role === 'admin') {
            next()
        } else {
            next({ path: '/login' })
        }
    } else {
        next()
    }
})

export default router
