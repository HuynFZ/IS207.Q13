<script setup>
import { ref, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useAuth } from '../utils/useAuth'
import Header from '../components/Header.vue'
import Footer from '../components/Footer.vue'

const router = useRouter()
const route = useRoute()
const { user } = useAuth()

// tabs
const tab = ref('posts') // posts | about | photos
const isFollowing = ref(false)
function toggleFollow(){ isFollowing.value = !isFollowing.value }
function goTab(name){ tab.value = name }

// simple heuristic: if route has a param `id` or query `user` and it's different from current user, treat as viewing other
const isMine = computed(() => {
  if (!user || !user.value) return false
  const id = route.params.id || route.query.user || route.query.view
  if (!id) return true // no id -> own profile
  // compare against common user fields
  const u = user.value
  const matches = [u.id, u.email, u.name].filter(Boolean).map(String)
  return matches.includes(String(id))
})

function editProfile(){ router.push('/profile/edit') }

const posts = ref([
  { id: 'S1', text: 'Mình bán 1 chiếc bàn gỗ, liên hệ nhé!', date: '2025-11-05', likes: 12, comments: 3 },
  { id: 'S2', text: 'Ai biết chỗ sửa xe gần Quận 3 không?', date: '2025-10-28', likes: 3, comments: 1 },
])

const photos = ref([
  { id: 'PH1' }, { id: 'PH2' }, { id: 'PH3' }, { id: 'PH4' }, { id: 'PH5' }, { id: 'PH6' }
])

const stats = computed(()=>({ posts: posts.value.length, followers: 2100, following: 180 }))
</script>

<template>
  <div>
    <Header />

    <div class="social-page container">
      <div class="top-return"><router-link to="/home">Trở về trang chủ</router-link></div>

      <section class="profile-hero">
        <div class="cover"></div>
        <div class="hero-inner">
          <div class="avatar">{{ user?.name ? user.name.charAt(0) : 'U' }}</div>
          <div class="meta">
            <div class="name">{{ user?.name || 'Người dùng' }}</div>
            <div class="handle">@{{ (user?.name || 'user').toLowerCase().replace(/\s+/g,'') }}</div>
            <div class="bio">Chào! Đây là trang cá nhân của tôi. Tôi bán đồ cũ, trao đổi ở khu vực TP.HCM.</div>
          </div>
          <div class="actions">
          <button v-if="isMine" class="btn primary edit" @click="editProfile">Chỉnh sửa trang cá nhân</button>
          <template v-else>
            <button class="btn primary" @click="toggleFollow">{{ isFollowing ? 'Đã theo dõi' : 'Theo dõi' }}</button>
            <button class="btn outline" @click.prevent="router.push('/messages')">Nhắn tin</button>
          </template>
          </div>
        </div>

        <div class="stats-row">
          <div class="stat"><div class="num">{{ stats.posts }}</div><div class="label">Bài đăng</div></div>
          <div class="stat"><div class="num">{{ stats.followers.toLocaleString() }}</div><div class="label">Người theo dõi</div></div>
          <div class="stat"><div class="num">{{ stats.following }}</div><div class="label">Đang theo dõi</div></div>
        </div>
      </section>

      <nav class="tabs">
        <button :class="{active: tab==='posts'}" @click="goTab('posts')">Bài viết</button>
        <button :class="{active: tab==='about'}" @click="goTab('about')">Giới thiệu</button>
        <button :class="{active: tab==='photos'}" @click="goTab('photos')">Ảnh</button>
      </nav>

      <main class="tab-content">
        <div v-show="tab==='posts'" class="posts">
          <div v-for="p in posts" :key="p.id" class="post card">
            <div class="post-head">
              <div class="avatar-sm">{{ user?.name ? user.name.charAt(0) : 'U' }}</div>
              <div class="post-meta">
                <div class="name">{{ user?.name || 'Người dùng' }}</div>
                <div class="date">{{ p.date }}</div>
              </div>
            </div>
            <div class="post-body">{{ p.text }}</div>
            <div class="post-footer">
              <div class="meta">❤ {{ p.likes }} · 💬 {{ p.comments }}</div>
              <div class="actions"><button class="link">Thích</button><button class="link">Bình luận</button></div>
            </div>
          </div>
        </div>

        <div v-show="tab==='about'" class="about card">
          <h3>Giới thiệu</h3>
          <p>Tôi là một người dùng hoạt động tại TP.HCM, chuyên bán và trao đổi đồ cũ. Liên hệ: 0123456789</p>
        </div>

        <div v-show="tab==='photos'" class="photos">
          <div class="grid">
            <div v-for="ph in photos" :key="ph.id" class="photo"></div>
          </div>
        </div>
      </main>
    </div>

    <Footer />
  </div>
</template>

<style scoped>
:root{ --bg:#f8fafc; --muted:#6b7280; --accent1:#6366f1; --accent2:#06b6d4; --card:#ffffff }
.container{ max-width:1100px; margin:28px auto; padding:24px; font-family:Inter, ui-sans-serif, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial }
.social-page{ background:linear-gradient(180deg, rgba(99,102,241,0.02), rgba(6,182,212,0.01)); padding:18px 20px; border-radius:14px }
.top-return{ margin-bottom:14px; display:flex; align-items:center }
.top-return a{ color:#374151; text-decoration:none; font-size:14px; font-weight:600 }
.top-return a::before{ content:'<'; margin-right:8px; color:#374151; font-weight:800 }

.profile-hero{ background:transparent; margin-bottom:18px }
.cover{ height:220px; background:linear-gradient(90deg,var(--accent2),var(--accent1)); border-radius:12px; box-shadow:0 8px 30px rgba(99,102,241,0.12); overflow:hidden }
.hero-inner{ display:flex; gap:20px; align-items:center; position:relative; transform:translateY(-60px) }
.avatar{ width:120px; height:120px; border-radius:20px; background:linear-gradient(180deg,#fff,#f8fafc); display:flex; align-items:center; justify-content:center; font-size:44px; font-weight:800; box-shadow:0 18px 40px rgba(15,23,42,0.12); border:4px solid rgba(255,255,255,0.85) }
.meta .name{ font-weight:800; font-size:20px; color:#0f172a }
.meta .handle{ color:var(--muted); font-size:13px; margin-top:2px }
.meta .bio{ margin-top:10px; color:#334155; max-width:600px }
.actions{ margin-left:auto; display:flex; gap:12px; align-items:center }

.btn{ padding:10px 14px; border-radius:12px; border:none; cursor:pointer; transition:all .18s ease; font-weight:600 }
.btn.primary{ background:linear-gradient(90deg,var(--accent1),#7c3aed); color:#fff; box-shadow:0 8px 20px rgba(99,102,241,0.18) }
.btn.primary:hover{ transform:translateY(-3px); box-shadow:0 14px 30px rgba(99,102,241,0.22) }
.btn.primary.edit{ background:linear-gradient(90deg,#10b981,#06b6d4) }
.btn.outline{ background:transparent; border:1px solid rgba(15,23,42,0.06); color:#0f172a }
.btn.outline:hover{ background:rgba(15,23,42,0.03); transform:translateY(-2px) }

.stats-row{ display:flex; gap:14px; margin-top:18px }
.stat{ background:linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.75)); padding:12px 18px; border-radius:12px; box-shadow:0 10px 30px rgba(2,6,23,0.06); display:flex; flex-direction:column; align-items:center; min-width:110px }
.stat .num{ font-weight:800; font-size:18px; color:#0f172a }
.stat .label{ color:var(--muted); font-size:13px }

.tabs{ display:flex; gap:12px; margin:18px 0 }
.tabs button{ padding:10px 14px; border-radius:12px; border:1px solid transparent; background:transparent; cursor:pointer; color:var(--muted); font-weight:700 }
.tabs button.active{ color:var(--accent1); background:linear-gradient(90deg, rgba(99,102,241,0.06), rgba(6,182,212,0.02)); box-shadow:inset 0 -2px 0 rgba(99,102,241,0.12) }

.tab-content{ display:flex; gap:20px }
.posts{ flex:1 }
.card{ background:var(--card); padding:16px; border-radius:14px; box-shadow:0 8px 30px rgba(2,6,23,0.06); margin-bottom:14px }
.post-head{ display:flex; gap:12px; align-items:center }
.avatar-sm{ width:44px; height:44px; border-radius:10px; background:linear-gradient(90deg,var(--accent1),#7c3aed); color:white; display:flex; align-items:center; justify-content:center; font-weight:700 }
.post-body{ margin-top:10px; color:#0f172a; line-height:1.5 }
.post-footer{ display:flex; justify-content:space-between; margin-top:12px; color:var(--muted); align-items:center }
.post-footer .actions .link{ background:transparent; border:none; color:var(--accent1); cursor:pointer; margin-left:8px }
.post.card:hover{ transform:translateY(-6px); box-shadow:0 18px 40px rgba(2,6,23,0.08) }

.about{ padding:18px }
.photos .grid{ display:grid; grid-template-columns:repeat(3,1fr); gap:12px }
.photo{ background:linear-gradient(180deg,#f3e8ff,#e0f2fe); height:140px; border-radius:12px; transition:transform .18s ease; box-shadow:0 8px 24px rgba(2,6,23,0.04) }
.photo:hover{ transform:scale(1.04) }

@media (max-width:900px){
  .hero-inner{ flex-direction:column; transform:none }
  .actions{ margin-left:0 }
  .tab-content{ flex-direction:column }
  .photos .grid{ grid-template-columns:repeat(2,1fr) }
  .cover{ height:160px }
}
</style>

