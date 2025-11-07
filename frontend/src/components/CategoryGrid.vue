<template>
  <section class="category-grid-section">
    <div class="category-grid">
      <a
          v-for="category in categories"
          :key="category.id"
          :href="category.url"
          class="category-item"
      >
        <span v-if="category.isNew" class="new-badge">Mới</span>

        <img :src="category.imageUrl" :alt="category.name" class="category-icon" />

        <span class="category-name" v-html="category.name"></span>
      </a>
    </div>

  </section>
</template>

<script setup>
import { ref } from 'vue';

const categories = ref([
  // Hàng 1
  { id: 1, name: 'Bất động sản', imageUrl: '/images/categories/bds.png', url: '#', isNew: false },
  { id: 2, name: 'Xe cộ', imageUrl: '/images/categories/xeco.png', url: '#', isNew: false },
  { id: 3, name: 'Thú cưng', imageUrl: '/images/categories/thucung.png', url: '#', isNew: false },
  { id: 4, name: 'Đồ gia dụng, nội<br>thất, cây cảnh', imageUrl: '/images/categories/dogiadung.png', url: '#', isNew: false },
  { id: 5, name: 'Giải trí, Thể thao, Sở<br>thích', imageUrl: '/images/categories/giaitri.png', url: '#', isNew: false },
  { id: 6, name: 'Mẹ và bé', imageUrl: '/images/categories/mevabe.png', url: '#', isNew: false },
  { id: 7, name: 'Dịch vụ, Du lịch', imageUrl: '/images/categories/dichvu.png', url: '#', isNew: false },
  { id: 8, name: 'Cho tặng miễn phí', imageUrl: '/images/categories/chotang.png', url: '#', isNew: false },
  // Hàng 2
  { id: 9, name: 'Việc làm', imageUrl: '/images/categories/vieclam.png', url: '#', isNew: false },
  { id: 10, name: 'Đồ điện tử', imageUrl: '/images/categories/dientu.png', url: '#', isNew: false },
  { id: 11, name: 'Tủ lạnh, máy lạnh,<br>máy giặt', imageUrl: '/images/categories/tulanh.png', url: '#', isNew: false },
  { id: 12, name: 'Đồ dùng văn phòng,<br>công nông nghiệp', imageUrl: '/images/categories/vanphong.png', url: '#', isNew: false },
  { id: 13, name: 'Thời trang, Đồ dùng<br>cá nhân', imageUrl: '/images/categories/thoitrang.png', url: '#', isNew: false },
  { id: 14, name: 'Đồ ăn, thực phẩm<br>và các loại khác', imageUrl: '/images/categories/doan.png', url: '#', isNew: false },
  { id: 15, name: 'Dịch vụ chăm sóc<br>nhà cửa', imageUrl: '/images/categories/dichvunha.png', url: '#', 'isNew': true },
  { id: 16, name: 'Tất cả danh mục', imageUrl: '/images/categories/tatca.png', url: '#', isNew: false },
]);
</script>

<style scoped>
/*
 * Khối container lớn màu trắng
 */
.category-grid-section {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 12px;
  margin-bottom: 20px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/*
 * Lưới chứa các danh mục
 */
.category-grid {
  display: grid;
  grid-template-columns: repeat(8, 1fr);
  gap: 15px;
}

/*
 * Từng mục danh mục (icon + text)
 */
.category-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  text-decoration: none;
  color: #333;
  font-size: 13px;
  font-weight: 500;
  line-height: 1.4;
  position: relative;
  transition: transform 0.2s ease;
}

.category-item:hover {
  transform: translateY(-3px);
  color: #007bff;
}

/*
 * Icon danh mục
 */
.category-icon {
  width: 56px;
  height: 56px;
  object-fit: contain;
  margin-bottom: 8px;
}

/*
 * Tên danh mục
 */
.category-name {
  height: 38px;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/*
 * Tag "Mới"
 */
.new-badge {
  position: absolute;
  top: -5px;
  right: 5px;
  background-color: #f84343;
  color: white;
  padding: 2px 6px;
  border-radius: 4px;
  font-size: 10px;
  font-weight: bold;
  text-transform: uppercase;
}

/*
 * PHẦN RESPONSIVE ĐẦY ĐỦ
 */
@media (max-width: 1200px) {
  .category-grid {
    grid-template-columns: repeat(6, 1fr);
  }
}

@media (max-width: 768px) {
  .category-grid {
    grid-template-columns: repeat(4, 1fr);
  }
  .category-icon {
    width: 50px;
    height: 50px;
  }
  .category-name {
    font-size: 12px;
  }
}

@media (max-width: 480px) {
  .category-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
  }
  .category-grid-section {
    padding: 15px;
  }
}
</style>