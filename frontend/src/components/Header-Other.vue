<template>
  <header class="app-header" ref="headerRef">
    <div class="container">

      <div class="left-section">
        <button class="menu-btn" title="Danh mục" @click.stop="toggleCategoryMenu">
          <font-awesome-icon icon="bars" />
        </button>
        <router-link to="/" class="logo">
          <img src="/logo.jpg" alt="VietMarket Logo">
        </router-link>
        <div class="category-dropdown-menu" v-if="isCategoryMenuOpen">
          <ul>
            <li @click="selectCategory('Xe cộ')">Xe cộ</li>
            <li @click="selectCategory('Đồ điện tử')">Đồ điện tử</li>
            <li @click="selectCategory('Thú cưng')">Thú cưng</li>
            <li @click="selectCategory('Đồ ăn, Thực phẩm và các loại khác')">Đồ ăn, Thực phẩm và các loại khác</li>
            <li @click="selectCategory('Tủ lạnh, Máy lạnh, Máy giặt')">Tủ lạnh, Máy lạnh, Máy giặt</li>
            <li @click="selectCategory('Đồ gia dụng, Nội thất, Cây cảnh')">Đồ gia dụng, Nội thất, Cây cảnh</li>
            <li @click="selectCategory('Thời trang, Đồ dùng cá nhân')">Thời trang, Đồ dùng cá nhân</li>
            <li @click="selectCategory('Giải trí, Thể thao, Sở thích')">Giải trí, Thể thao, Sở thích</li>
            <li @click="selectCategory('Đồ dùng văn phòng, Công nông nghiệp')">Đồ dùng văn phòng, Công nông nghiệp</li>
          </ul>
        </div>
      </div>

      <div class="center-section">
        <div class="location-picker" @click="isLocationPickerOpen = true">
          <font-awesome-icon icon="map-marker-alt" />
          <span>{{ selectedLocation }}</span>
          <font-awesome-icon icon="chevron-down" class="arrow" />
        </div>
        <div class="search-bar">
          <input type="text" placeholder="Tìm sản phẩm...">
          <button class="search-btn">
            <font-awesome-icon icon="search" />
          </button>
        </div>
      </div>
      
      <div class="right-section">
        <div class="action-icons">
          <button class="icon-btn" title="Yêu thích">
            <font-awesome-icon icon="heart" />
          </button>
          <button class="icon-btn" title="Trò chuyện" @click="handleChatClick">
            <font-awesome-icon icon="comment" />
          </button>
          <button class="icon-btn" title="Thông báo">
            <font-awesome-icon icon="bell" />
          </button>
        </div>
        
        <button class="post-btn">
          Đăng tin
        </button>

        <div class="user-actions">
          <template v-if="!isLoggedIn">
            <router-link to="/login" class="auth-btn login-btn">Đăng nhập</router-link>
            <router-link to="/register" class="auth-btn register-btn">Đăng ký</router-link>
          </template>
          <template v-else>
            <router-link to="/manage-posts" class="manage-btn">Quản lý tin</router-link>
            <div class="avatar-wrapper" @click.stop="toggleUserMenu">
              <img src="/avatar.jpg" alt="Avatar" class="avatar">
              <font-awesome-icon icon="chevron-down" class="arrow-small" />
              <div v-if="isUserMenuOpen" class="user-dropdown">
                <router-link to="/profile/social">Trang cá nhân</router-link>
                <router-link to="/profile">Thông tin cá nhân</router-link>
                <router-link v-if="user && user.role === 'admin'" to="/admin" class="admin-link">Admin</router-link>
                <button @click="handleLogout">Đăng xuất</button>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
    
  </header>

  <LocationPickerModal 
    v-if="isLocationPickerOpen"
    @close="isLocationPickerOpen = false"
    @applyLocation="handleLocationApply"
  />
  <AuthRedirectModal
    v-if="isAuthModalOpen"
    @close="isAuthModalOpen = false"
  />
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useRouter } from 'vue-router'; 
import LocationPickerModal from './LocationPickerModal.vue';
import { useAuth } from '../utils/useAuth';
// import LoginModal from './LoginModal.vue'; // <-- ĐÃ XÓA (Không dùng modal)

const isCategoryMenuOpen = ref(false);
const headerRef = ref(null);
const router = useRouter();

// Lấy trạng thái từ useAuth
const { isLoggedIn, user, logout } = useAuth();
const isUserMenuOpen = ref(false);

const isLocationPickerOpen = ref(false);
const selectedLocation = ref('Toàn quốc');

// const isLoginModalOpen = ref(false); // <-- ĐÃ XÓA

const handleLocationApply = (locationName) => {
  selectedLocation.value = locationName;
  isLocationPickerOpen.value = false;
};
// ------------------------------

// const handleLogin = () => { ... }; // <-- ĐÃ XÓA (Vì <router-link> sẽ xử lý)
// const onLoginSuccess = () => { ... }; // <-- ĐÃ XÓA

// SỬA ĐỔI: Hàm xử lý khi bấm nút Chat
const handleChatClick = () => {
  if (isLoggedIn.value) {
    router.push('/chat'); // Nếu đã đăng nhập, chuyển trang
  } else {
    router.push('/login'); // Nếu chưa, chuyển đến trang /login
  }
};

// (Các hàm logic cũ giữ nguyên)
const handleLogout = () => { 
  logout(); // Gọi hàm logout của useAuth
  isUserMenuOpen.value = false; 
};

const toggleUserMenu = () => { isUserMenuOpen.value = !isUserMenuOpen.value; };
const toggleCategoryMenu = () => { isCategoryMenuOpen.value = !isCategoryMenuOpen.value; };
const selectCategory = (categoryName) => {
  router.push({ 
    path: '/products', 
    query: { category: categoryName } 
  });
  isCategoryMenuOpen.value = false;
};
const handleClickOutside = (event) => {
  if (isCategoryMenuOpen.value && headerRef.value && !headerRef.value.contains(event.target)) {
    isCategoryMenuOpen.value = false;
  }
  if (isUserMenuOpen.value && headerRef.value && !headerRef.value.contains(event.target)) {
     isUserMenuOpen.value = false;
  }
};
onMounted(() => { document.addEventListener('click', handleClickOutside); });
onBeforeUnmount(() => { document.removeEventListener('click', handleClickOutside); });
</script>

<style scoped>
/* (Toàn bộ CSS giữ nguyên) */
.app-header {
  background: white;
  border-bottom: 1px solid #e0e0e0;
  padding: 0.75rem 0;
  position: relative; 
  z-index: 1001;
}
.container {
  max-width: 1400px;
  margin: 0 auto;
  padding: 0 0.5rem;
  display: flex;
  align-items: center;
  gap: 1.5rem;
}
.left-section {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  position: relative;
}
.menu-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: #333;
}
.logo img {
  height: 40px;
  display: block;
}
.center-section {
  flex-grow: 1;
  display: flex;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
}
.location-picker {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0 1.25rem;
  background-color: #f5f5f5;
  border-right: 1px solid #ddd;
  cursor: pointer;
  white-space: nowrap;
}
.location-picker .arrow {
  font-size: 0.8rem;
}
.search-bar {
  display: flex;
  flex-grow: 1;
}
.search-bar input {
  flex-grow: 1;
  border: none;
  outline: none;
  padding: 0.75rem 1rem;
  font-size: 1rem;
}
.search-bar .search-btn {
  background-color: #f5a623;
  border: none;
  padding: 0 1.5rem;
  cursor: pointer;
  font-size: 1.1rem;
  color: black;
}
.right-section {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}
.action-icons {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}
.icon-btn {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1.4rem;
  color: #333;
}
.post-btn {
  background-color: #f5a623;
  color: black;
  font-weight: bold;
  border: none;
  padding: 0.75rem 1.25rem;
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.9rem;
  white-space: nowrap;
}
.user-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.manage-btn {
  text-decoration: none;
  color: #333;
  font-weight: 500;
  white-space: nowrap;

  /* BỔ SUNG: Thêm các dòng này để tạo viền nút */
  border: 1px solid #ccc;
  padding: 0.6rem 1rem;
  border-radius: 8px;
}

/* (Tùy chọn) Thêm hiệu ứng hover */
.manage-btn:hover {
  border-color: #007bff;
  background-color: #f5f5f5;
}
/* SỬA ĐỔI: Thêm CSS cho <router-link> */
.auth-btn {
  padding: 0.75rem 1.25rem; 
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold; 
  font-size: 0.9rem; 
  text-decoration: none; /* <-- Bắt buộc cho router-link */
  display: inline-block; /* <-- Bắt buộc cho router-link */
}
.login-btn {
  background-color: #f5a623;
  color: black;
}
.register-btn {
  background-color: #eee;
  color: #333;
}
.avatar-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  cursor: pointer;
}
.avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: #6f42c1;
  border: 2px solid white;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
}
.arrow-small {
  font-size: 0.8rem;
}
.user-dropdown {
  position: absolute;
  top: 120%;
  right: 0;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  padding: 0.5rem;
  width: 200px;
  z-index: 100;
  display: flex;
  flex-direction: column;
}
.user-dropdown a,
.user-dropdown button {
  padding: 0.75rem 1rem;
  border: none;
  background: none;
  text-align: left;
  cursor: pointer;
  border-radius: 4px;
  text-decoration: none;
  color: #333;
}
.user-dropdown a:hover,
.user-dropdown button:hover {
  background-color: #f5f5f5;
}
.category-dropdown-menu {
  position: absolute; 
  top: calc(100% + 10px);
  left: 0;
  min-width: 300px;
  background: white;
  border-bottom: 1px solid #eee;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  max-height: 400px;
  overflow-y: auto;
  border-radius: 8px;
}
.category-dropdown-menu ul {
  list-style: none;
  padding: 0.5rem;
  margin: 0;
}
.category-dropdown-menu li {
  padding: 0.75rem 1rem;
  font-size: 1rem;
  cursor: pointer;
  border-radius: 4px;
}
.category-dropdown-menu li:hover {
  background-color: #f5f5f5;
}
</style>