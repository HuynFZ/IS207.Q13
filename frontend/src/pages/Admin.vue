<script setup>
import { ref } from 'vue'
import { useAuth } from '../utils/useAuth'
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

const { user } = useAuth()

// Mock data
const stats = ref({ users: 1284, postsPending: 12, sales: '₫125,400,000' })

const pendingPosts = ref([
  { id: 'P1001', title: 'Bán bàn gỗ cũ', author: 'Nguyen A', date: '2025-11-01' },
  { id: 'P1002', title: 'Cần mua xe đạp', author: 'Tran B', date: '2025-11-03' },
])

function approve(postId){
  const idx = pendingPosts.value.findIndex(p=>p.id===postId)
  if(idx!==-1) pendingPosts.value.splice(idx,1)
}

function reject(postId){
  const idx = pendingPosts.value.findIndex(p=>p.id===postId)
  if(idx!==-1) pendingPosts.value.splice(idx,1)
}
</script>

<template>
  <div class="page">
    <Header />
    <main class="content">
      <div class="container admin-page">
        <div class="admin-head">
          <h1>Dashboard Quản trị</h1>
          <div class="sub">Xin chào, <strong>{{ user?.name || 'Admin' }}</strong></div>
        </div>

        <div class="cards">
          <div class="card">
            <div class="num">{{ stats.users }}</div>
            <div class="label">Người dùng</div>
          </div>
          <div class="card">
            <div class="num">{{ stats.postsPending }}</div>
            <div class="label">Bài đăng chờ duyệt</div>
          </div>
          <div class="card">
            <div class="num">{{ stats.sales }}</div>
            <div class="label">Doanh thu</div>
          </div>
        </div>

        <section class="pending">
          <h2>Bài đăng chờ duyệt</h2>
          <div v-if="pendingPosts.length" class="list">
            <div v-for="p in pendingPosts" :key="p.id" class="post">
              <div class="meta">
                <div class="title">{{ p.title }}</div>
                <div class="author">{{ p.author }} • {{ p.date }}</div>
              </div>
              <div class="actions">
                <button class="btn approve" @click="approve(p.id)">Duyệt</button>
                <button class="btn reject" @click="reject(p.id)">Từ chối</button>
              </div>
            </div>
          </div>
          <div v-else>Không có bài đăng nào đang chờ.</div>
        </section>
      </div>
    </main>
    <Footer />
  </div>
</template>

<style scoped>
.page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.content {
  flex: 1;
  padding: 2rem 1rem;
  background: #f8f9fa;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
  margin-bottom: 1rem;
}

.admin-page{ padding:28px }
.admin-head h1{ margin:0 0 6px 0 }
.admin-head .sub{ color:#555; margin-bottom:18px }
.cards{ display:flex; gap:12px; margin-bottom:20px }
.card{ background:white; padding:14px; border-radius:10px; box-shadow:0 6px 18px rgba(37,44,97,0.04); flex:1 }
.card .num{ font-size:20px; font-weight:700 }
.card .label{ color:#666 }
.pending .list{ display:flex; flex-direction:column; gap:10px }
.post{ display:flex; align-items:center; justify-content:space-between; background:#fff; padding:12px; border-radius:8px }
.post .meta .title{ font-weight:600 }
.post .meta .author{ color:#666; font-size:13px }
.btn{ padding:8px 10px; border-radius:8px; border:none; cursor:pointer }
.btn.approve{ background:#10b981; color:white }
.btn.reject{ background:#ef4444; color:white; margin-left:8px }
</style>
