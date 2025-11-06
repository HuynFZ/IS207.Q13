import { ref } from 'vue';

const toastMessage = ref('');
const toastType = ref('');
const toastKey = ref(0);

export function useToast() {
  const showToast = (message, type = 'info', duration = 3000) => {
    toastMessage.value = message;
    toastType.value = type;
    toastKey.value++;

    if (duration > 0) {
      setTimeout(() => {
        closeToast();
      }, duration);
    }
  };

  const closeToast = () => {
    toastMessage.value = '';
    toastType.value = '';
  };

  return {
    toastMessage,
    toastType,
    toastKey,
    showToast,
    closeToast,
  };
}