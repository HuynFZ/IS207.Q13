<script setup>
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <div class="page">
    <Header />
    <main class="container">

      <SearchFilterBar />
      <CategoryGrid />

      <section class="product-listings">

        <div class="tabs">
          <button
              :class="{ active: activeTab === 'for-you' }"
              @click="setActiveTab('for-you')">
            Dành cho bạn
          </button>
          <button
              :class="{ active: activeTab === 'newest' }"
              @click="setActiveTab('newest')">
            Mới nhất
          </button>
          <button
              :class="{ active: activeTab === 'trending' }"
              @click="setActiveTab('trending')">
            Xu hướng
          </button>
        </div>

        <div class="product-grid">
          <ProductCard
              v-for="product in products"
              :key="product.id"
              :product="product"
          />
        </div>

        <div v-if="products.length === 0 && loading" class="empty-state">
          Đang tải sản phẩm...
        </div>

        <div v-if="hasMoreProducts" class="see-more-container">
          <button class="see-more-btn" @click="loadMore" :disabled="loading">
            {{ loading ? 'Đang tải...' : 'Xem thêm' }}
          </button>
        </div>
      </section>

      <section class="about-us">
        <h2>VietMarket - Cho đồ cũ một đời mới, cho bạn một trải nghiệm hay</h2>
        <p>Chúng tôi tin rằng giá trị không nằm ở việc "mới" hay "cũ"...</p>
      </section>

    </main>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

// --- COMPONENT IMPORTS ---
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import CategoryGrid from '../components/CategoryGrid.vue';
import ProductCard from '../components/Product/ProductCard_NoReceive.vue';
import SearchFilterBar from '../components/SearchFilterBar.vue';

// --- TẠO MỘT "DATABASE" GIẢ LẬP LỚN ---
// (Tạo 30 sản phẩm để test: 12 + 8 + 8 + 2)
const mockDB = [];
for (let i = 1; i <= 30; i++) {
  mockDB.push({
    id: i,
    title: `Sản phẩm mẫu ${i}`,
    price: `${(i * 100 + 50)}.000 đ`,
    originalPrice: `${(i * 100 + 150)}.000 đ`,
    seller: 'Shop VietMarket',
    location: `Quận ${i % 12 + 1}, TP. HCM`,
    imageUrl: `https://via.placeholder.com/200/${Math.floor(Math.random()*16777215).toString(16)}/FFFFFF?text=Product+${i}`
  });
}

// --- PAGE STATE (ĐÃ CẬP NHẬT) ---
const activeTab = ref('for-you');
const products = ref([]);
const loading = ref(false);
const pageToLoad = ref(1); // Theo dõi trang hiện tại
const hasMoreProducts = ref(true); // Theo dõi xem còn SP để tải không

// --- HÀM LẤY DỮ LIỆU (ĐÃ CẬP NHẬT) ---
const fetchProducts = async () => {
  if (loading.value) return;
  loading.value = true;

  try {
    const isInitialLoad = (pageToLoad.value === 1);
    const limit = isInitialLoad ? 12 : 8; // Lần đầu tải 12, các lần sau tải 8

    // Tính toán offset (vị trí bắt đầu lấy)
    // Trang 1: offset 0, (lấy 12) -> [0-11]
    // Trang 2: offset 12, (lấy 8) -> [12-19]
    // Trang 3: offset 20, (lấy 8) -> [20-27]
    const offset = isInitialLoad ? 0 : 12 + (pageToLoad.value - 2) * 8;

    console.log(`Đang tải tab: ${activeTab.value}, Trang: ${pageToLoad.value}, Giới hạn: ${limit}, Offset: ${offset}`);

    // === NƠI BẠN GỌI API THẬT ===
    // (Trong API thật, bạn chỉ cần truyền 'pageToLoad' và 'limit'
    // hoặc 'offset' và 'limit' cho backend)
    // const response = await axios.get(`/api/products?tab=${activeTab.value}&page=${pageToLoad.value}&limit=${limit}`);
    // const newData = response.data.products;

    // === DỮ LIỆU GIẢ LẬP (SỬ DỤNG .slice()) ===
    await new Promise(r => setTimeout(r, 500)); // Giả lập chờ mạng
    const newData = mockDB.slice(offset, offset + limit);
    // ---------------------------------

    // Nối dữ liệu mới vào danh sách hiện tại
    products.value.push(...newData);

    // Kiểm tra xem còn sản phẩm để tải nữa không
    if (newData.length < limit || products.value.length === mockDB.length) {
      hasMoreProducts.value = false;
    }

  } catch (error) {
    console.error('Lỗi khi tải sản phẩm:', error);
  } finally {
    loading.value = false;
  }
};

// Gọi hàm fetchProducts() khi component được mount
onMounted(() => {
  fetchProducts(); // Tự động tải 12 SP đầu tiên
});

// --- HÀM KHI CHUYỂN TAB (ĐÃ CẬP NHẬT) ---
const setActiveTab = (tabName) => {
  activeTab.value = tabName;
  products.value = []; // Xóa sản phẩm cũ
  pageToLoad.value = 1; // Reset về trang 1
  hasMoreProducts.value = true; // Reset nút "Xem thêm"
  fetchProducts(); // Tải 12 SP đầu tiên cho tab mới
};

// --- HÀM MỚI KHI NHẤN "XEM THÊM" ---
const loadMore = () => {
  pageToLoad.value++; // Tăng số trang
  fetchProducts(); // Tải 8 sản phẩm tiếp theo
};
</script>

<style scoped>
/* (Toàn bộ CSS của bạn giữ nguyên, không thay đổi) */
.home-page {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  background-color: #f4f4f4;
}

.content {
  flex: 1;
  padding: 2rem 1rem;
}

.container {
  max-width: 1200px;
  margin: 20px auto;
  padding: 0 15px;
  flex-grow: 1;
  position: relative;
  z-index: 2;
}
.product-listings,
.about-us {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
.tabs {
  display: flex;
  gap: 10px;
  border-bottom: 2px solid #eee;
  margin-bottom: 20px;
}
.tabs button {
  padding: 10px 20px;
  border: none;
  background-color: transparent;
  cursor: pointer;
  font-size: 1rem;
  font-weight: 500;
  color: #777;
  border-bottom: 3px solid transparent;
}
.tabs button.active {
  color: #007bff;
  border-bottom-color: #007bff;
}
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 20px;
}
.empty-state {
  text-align: center;
  padding: 50px;
  color: #777;
  font-style: italic;
}
.see-more-container {
  text-align: center;
  margin-top: 30px;
}
.see-more-btn {
  padding: 12px 40px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.2s;
}
.see-more-btn:hover {
  background-color: #0056b3;
}
.see-more-btn:disabled {
  background-color: #999;
  cursor: not-allowed;
}
.about-us h2 {
  font-size: 1.2rem;
  font-weight: bold;
}
.about-us p {
  font-size: 0.9rem;
  line-height: 1.6;
  color: #555;
}
</style>