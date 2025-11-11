<template>
  <header>
    <div class="container">
      <div class="logo">VietMarket</div>
      <nav>
        <router-link to="/">🏠 Trang chủ</router-link>
        <router-link to="/products">🏷️ Sản phẩm</router-link>
        <router-link to="/contact">✉️ Liên hệ</router-link>
        <!-- Login or Profile -->
        <template v-if="isLoggedIn">
          <router-link to="/profile/social" class="personal-link">Trang Cá Nhân</router-link>
          <router-link to="/profile" class="login-btn">👤 Hồ sơ</router-link>
          <router-link v-if="user && user.role === 'admin'" to="/admin" class="admin-link">⚙️ Admin</router-link>
        </template>
        <template v-else>
          <router-link to="/login" class="login-btn">🔐 Đăng nhập</router-link>
        </template>
      </nav>
    </div>
  </header>
</template>

<script setup>
import { useAuth } from '../utils/useAuth'
const { isLoggedIn, user } = useAuth()
</script>

<style scoped>
header {
  background: white;
  border-bottom: 1px solid #e0e0e0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  font-weight: bold;
  font-size: 1.5rem;
}

nav {
  display: flex;
  gap: 2rem;
}

/* Áp dụng CSS để căn chỉnh Icon Unicode và chữ */
nav a, nav router-link { 
  text-decoration: none;
  color: #333;
  display: flex; 
  align-items: center;
  gap: 0.5rem; /* Tạo khoảng cách giữa icon và chữ */
}

.login-btn{
  background: #6366f1;
  color: white;
  padding: 6px 10px;
  border-radius: 8px;
  font-weight:600;
}
.login-btn:hover{ opacity:0.95 }
/* Personal profile link (Social profile) */
.personal-link{
  color:#111;
  font-weight:600;
  padding:6px 10px;
  border-radius:8px;
  background: linear-gradient(90deg, rgba(99,102,241,0.08), rgba(99,102,241,0.03));
}
.personal-link:hover{ background: rgba(99,102,241,0.12) }
</style>