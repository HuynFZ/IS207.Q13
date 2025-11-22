<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from '../utils/useAuth'
import HeaderOther from '../components/Header-Other.vue'
import Footer from '../components/Footer.vue'
import CascadingCategoryModal from '../components/CascadingCategoryModal.vue'

const router = useRouter()
const { user } = useAuth()

// Form state
const category = ref('')
const isCategoryModalOpen = ref(false)
const condition = ref('')
const accessoryType = ref('')
const warranty = ref('')
const origin = ref('')
const freeGift = ref(false)
const price = ref('')
const title = ref('')
const description = ref('')
const sellerType = ref('personal') // 'personal' or 'business'
const location = ref('')

// File upload state
const photos = ref([])
const video = ref(null)
const photoInput = ref(null)
const videoInput = ref(null)

// Handlers
const handlePhotoUpload = (event) => {
  const files = Array.from(event.target.files)
  if (photos.value.length + files.length <= 6) {
    photos.value.push(...files.slice(0, 6 - photos.value.length))
  } else {
    alert('Bạn chỉ có thể đăng tối đa 6 hình ảnh')
  }
}

const handleVideoUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    video.value = file
  }
}

const triggerPhotoUpload = () => {
  photoInput.value?.click()
}

const triggerVideoUpload = () => {
  videoInput.value?.click()
}

const handlePreview = () => {
  console.log('Preview post')
}

const handleSaveDraft = () => {
  console.log('Save draft')
}

const handleCategorySelect = (selectedCategory) => {
  category.value = selectedCategory
  isCategoryModalOpen.value = false
}

const openCategoryModal = () => {
  isCategoryModalOpen.value = true
}

const handleSubmit = () => {
  console.log('Submit post', {
    category: category.value,
    condition: condition.value,
    accessoryType: accessoryType.value,
    warranty: warranty.value,
    origin: origin.value,
    freeGift: freeGift.value,
    price: price.value,
    title: title.value,
    description: description.value,
    sellerType: sellerType.value,
    location: location.value,
    photos: photos.value,
    video: video.value
  })
  alert('Đăng tin thành công!')
  router.push('/home')
}
</script>

<template>
  <div class="create-post-page">
    <HeaderOther />

    <!-- Main Content -->
    <div class="content-wrapper">
      <div class="main-content">
        <!-- Left Panel: Upload Section -->
        <div class="upload-section">
          <h2 class="section-title">Hình ảnh và Video sản phẩm</h2>
          <p class="upload-hint">
            Xem thêm về <a href="#" class="link-blue">Quy định đăng tin của VietMarket</a>
          </p>
          
          <!-- Photo Upload Box -->
          <div class="upload-box" @click="triggerPhotoUpload">
            <input 
              ref="photoInput" 
              type="file" 
              accept="image/*" 
              multiple 
              style="display: none" 
              @change="handlePhotoUpload"
            />
            <div class="upload-icon">📷</div>
            <p class="upload-text">ĐĂNG TỪ 01 ĐẾN 06 HÌNH</p>
            <div class="info-tag">
              <span class="info-icon">ℹ️</span>
              <span>Hình ảnh hợp lệ</span>
            </div>
          </div>
          
          <!-- Video Upload Box -->
          <div class="upload-box" @click="triggerVideoUpload">
            <input 
              ref="videoInput" 
              type="file" 
              accept="video/*" 
              style="display: none" 
              @change="handleVideoUpload"
            />
            <div class="upload-icon">🎥</div>
            <p class="upload-text-bold">Đăng video để bán nhanh hơn</p>
            <div class="info-tag">
              <span class="info-icon">ℹ️</span>
              <span>Video hợp lệ</span>
            </div>
          </div>
        </div>

        <!-- Right Panel: Form Section -->
        <div class="form-section">
          <!-- Category Dropdown -->
          <div class="category-box" @click="openCategoryModal">
            <div class="category-header">
              <span class="category-label-small">Danh Mục Tin Đăng <span class="required">*</span></span>
            </div>
            <div class="category-value">
              <span>{{ category || 'Chọn danh mục...' }}</span>
              <span class="dropdown-arrow">▼</span>
            </div>
          </div>

          <!-- Details Section -->
          <div class="details-section">
            <h3 class="details-title">Thông tin chi tiết</h3>
            
            <div class="input-wrapper">
              <select v-model="condition" class="form-select" required>
                <option value="" disabled>Tình trạng *</option>
                <option value="new">Mới</option>
                <option value="used">Đã sử dụng</option>
              </select>
            </div>
            
            <div class="input-wrapper">
              <select v-model="accessoryType" class="form-select" required>
                <option value="" disabled>Loại phụ kiện *</option>
                <option value="monitor">Màn hình</option>
                <option value="mouse">Chuột</option>
                <option value="keyboard">Bàn phím</option>
                <option value="other">Khác</option>
              </select>
            </div>
            
            <div class="input-wrapper">
              <input v-model="warranty" type="text" placeholder="Chính sách bảo hành" class="form-input" />
            </div>
            
            <div class="input-wrapper">
              <input v-model="origin" type="text" placeholder="Xuất xứ" class="form-input" />
            </div>
            
            <div class="checkbox-wrapper">
              <input v-model="freeGift" type="checkbox" id="freeGift" />
              <label for="freeGift">Tôi muốn cho tặng miễn phí</label>
            </div>
            
            <div class="input-wrapper">
              <input v-model="price" type="number" placeholder="Giá bán *" class="form-input" required />
            </div>
          </div>

          <!-- Title and Description Section -->
          <div class="title-description-section">
            <h3 class="details-title">Tiêu đề tin đăng và Mô tả chi tiết</h3>
            
            <div class="textarea-wrapper">
              <input v-model="title" type="text" placeholder="Tiêu đề tin đăng *" class="form-input" maxlength="50" required />
              <span class="char-count">{{ title.length }}/50 kí tự</span>
            </div>
            
            <div class="textarea-wrapper">
              <textarea 
                v-model="description" 
                placeholder="Mô tả chi tiết *&#10;• Bảo hành nếu có&#10;• Sửa chữa nâng cấp, phụ kiện đi kèm&#10;• Chấp nhận thanh toán/vận chuyển qua VietMarket" 
                class="form-textarea" 
                maxlength="1500"
                required
              ></textarea>
              <span class="char-count">{{ description.length }}/1500 kí tự</span>
            </div>
          </div>

          <!-- Seller Info Section -->
          <div class="seller-section">
            <h3 class="details-title">Thông tin người bán</h3>
            <p class="seller-label">Bạn là <span class="required">*</span></p>
            
            <div class="seller-type-btns">
              <button 
                :class="['seller-btn', { active: sellerType === 'personal' }]"
                @click="sellerType = 'personal'"
              >
                Cá nhân
              </button>
              <button 
                :class="['seller-btn', { inactive: sellerType !== 'business' }]"
                @click="sellerType = 'business'"
              >
                Bán chuyên
              </button>
            </div>
            
            <div class="input-wrapper">
              <select v-model="location" class="form-select" required>
                <option value="" disabled>Địa chỉ *</option>
                <option value="hcm">TP. Hồ Chí Minh</option>
                <option value="hanoi">Hà Nội</option>
                <option value="danang">Đà Nẵng</option>
                <option value="other">Khác</option>
              </select>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Fixed Bottom Action Buttons -->
    <div class="action-buttons-fixed">
      <div class="action-buttons">
        <button class="btn-secondary" @click="handlePreview">Xem trước</button>
        <button class="btn-secondary" @click="handleSaveDraft">Lưu nháp</button>
        <button class="btn-primary" @click="handleSubmit">Đăng tin</button>
      </div>
    </div>

    <Footer />

    <CascadingCategoryModal
      v-if="isCategoryModalOpen"
      @close="isCategoryModalOpen = false"
      @select="handleCategorySelect"
    />
  </div>
</template>

<style scoped>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.create-post-page {
  min-height: 100vh;
  background-color: #f4f4f4;
  display: flex;
  flex-direction: column;
  padding-bottom: 80px; /* Space for fixed buttons */
}

/* Main Content */
.content-wrapper {
  width: 100%;
  max-width: 1440px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  margin: 0 auto;
}

.main-content {
  width: 100%;
  max-width: 967px;
  background: white;
  padding: 44px 36px;
  display: flex;
  gap: 66px;
}

/* Upload Section */
.upload-section {
  width: 329px;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.section-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 20px;
  color: black;
  margin-bottom: 8px;
}

.upload-hint {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  color: black;
  margin-bottom: 12px;
}

.link-blue {
  color: #1889d9;
  text-decoration: underline;
}

.upload-box {
  width: 280px;
  height: 296px;
  background: rgba(217, 217, 217, 0.5);
  border: 3px dashed #448aff;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  position: relative;
  margin-bottom: 16px;
}

.upload-icon {
  font-size: 60px;
  margin-bottom: 16px;
}

.upload-text {
  font-family: 'Poppins', sans-serif;
  font-size: 10px;
  color: rgba(97, 93, 93, 0.5);
  text-align: center;
}

.upload-text-bold {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 10px;
  color: black;
  text-align: center;
}

.info-tag {
  position: absolute;
  bottom: 13px;
  right: 10px;
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 10px;
  color: black;
}

.info-icon {
  font-size: 12px;
}

/* Form Section */
.form-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.category-box {
  border: 1px solid #b1acac;
  border-radius: 5px;
  padding: 8px 12px;
  display: flex;
  flex-direction: column;
  gap: 4px;
  cursor: pointer;
  transition: all 0.2s;
}

.category-box:hover {
  border-color: #448aff;
  background: #f8fafc;
}

.category-header {
  display: flex;
  align-items: center;
}

.category-label-small {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 10px;
  color: black;
}

.category-value {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 15px;
  color: black;
}

.dropdown-arrow {
  font-size: 14px;
  color: #666;
}

.required {
  color: #f43f3f;
}

.details-section,
.title-description-section,
.seller-section {
  display: flex;
  flex-direction: column;
  gap: 22px;
}

.details-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 700;
  font-size: 20px;
  color: black;
}

.input-wrapper {
  position: relative;
  display: flex;
  flex-direction: column;
}

.form-input,
.form-select {
  width: 100%;
  max-width: 500px;
  height: 44px;
  border: 1px solid rgba(139, 137, 137, 0.5);
  border-radius: 5px;
  padding: 0 18px;
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  color: rgba(97, 93, 93, 0.5);
  outline: none;
}

.form-input:focus,
.form-select:focus {
  border-color: #448aff;
  color: black;
}

.checkbox-wrapper {
  display: flex;
  align-items: center;
  gap: 12px;
}

.checkbox-wrapper input[type="checkbox"] {
  width: 20px;
  height: 19px;
  background: #d9d9d9;
  border-radius: 5px;
  cursor: pointer;
}

.checkbox-wrapper label {
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  color: black;
  cursor: pointer;
}

.textarea-wrapper {
  position: relative;
  display: flex;
  flex-direction: column;
}

.form-textarea {
  width: 100%;
  max-width: 500px;
  min-height: 113px;
  border: 1px solid rgba(139, 137, 137, 0.5);
  border-radius: 5px;
  padding: 18px;
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  color: rgba(97, 93, 93, 0.5);
  resize: vertical;
  outline: none;
}

.form-textarea:focus {
  border-color: #448aff;
  color: black;
}

.char-count {
  margin-top: 4px;
  font-family: 'Poppins', sans-serif;
  font-size: 10px;
  color: #615d5d;
  align-self: flex-start;
}

.seller-label {
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  color: rgba(97, 93, 93, 0.5);
}

.seller-type-btns {
  display: flex;
  gap: 11px;
  padding: 0 39px;
}

.seller-btn {
  height: 30px;
  padding: 0 16px;
  border-radius: 50px;
  border: none;
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  cursor: pointer;
  transition: all 0.3s;
}

.seller-btn.active {
  background: linear-gradient(90deg, rgba(239, 148, 2, 0.5), rgba(35, 145, 235, 0.5));
  color: black;
  font-weight: 600;
}

.seller-btn.inactive {
  background: rgba(139, 137, 137, 0.5);
  color: black;
  font-weight: 300;
}

/* Fixed Action Buttons */
.action-buttons-fixed {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: white;
  box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  display: flex;
  justify-content: center;
  padding: 12px 20px;
}

.action-buttons {
  display: flex;
  justify-content: center;
  gap: 47px;
}

.btn-secondary,
.btn-primary {
  width: 132px;
  padding: 10px 12px;
  border-radius: 5px;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 18px;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-secondary {
  background: white;
  border: 1px solid #8b8989;
  color: rgba(0, 0, 0, 0.8);
}

.btn-secondary:hover {
  background: #f5f5f5;
}

.btn-primary {
  background: #d47b15;
  border: none;
  color: rgba(255, 255, 255, 0.8);
}

.btn-primary:hover {
  background: #b86a12;
  transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 1024px) {
  .main-content {
    flex-direction: column;
    gap: 30px;
  }
  
  .upload-section {
    width: 100%;
  }
  
  .upload-box {
    width: 100%;
  }
}
</style>
