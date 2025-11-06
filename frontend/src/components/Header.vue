<template>
  <header>
    <div class="container">
      <div class="logo">VietMarket</div>
      <nav>
        <router-link to="/">🏠 Trang chủ</router-link>
        
        <router-link to="/products">🏷️ Sản phẩm</router-link> 
        
        <router-link to="/contact">✉️ Liên hệ</router-link>
      </nav>
    </div>
  </header>
</template>

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
</style>