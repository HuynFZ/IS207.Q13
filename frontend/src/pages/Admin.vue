<script setup>
import Header from '../components/Header-HomePage.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <div class="page">
    <Header />
    <main class="content">
      <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Admin content goes here</p>
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
</style>
