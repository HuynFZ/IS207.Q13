import { ref, computed } from 'vue'

const tokenKey = 'app_token'
const userKey = 'app_user'

const token = ref(localStorage.getItem(tokenKey) || '')
const user = ref(JSON.parse(localStorage.getItem(userKey) || 'null'))

function login(newToken, userInfo = null){
  token.value = newToken
  user.value = userInfo
  localStorage.setItem(tokenKey, newToken)
  if(userInfo) localStorage.setItem(userKey, JSON.stringify(userInfo))
}

function logout(){
  token.value = ''
  user.value = null
  localStorage.removeItem(tokenKey)
  localStorage.removeItem(userKey)
}

const isLoggedIn = computed(()=> !!token.value)

export function useAuth(){
  return {
    token,
    user,
    isLoggedIn,
    login,
    logout
  }
}

export default useAuth
