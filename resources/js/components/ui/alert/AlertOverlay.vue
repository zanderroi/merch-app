<script setup lang="ts">
import { ref, watch } from 'vue'

const props = defineProps<{
  type: 'success' | 'error',
  message: string
}>()

const visible = ref(true)

// auto-close after 4 seconds
watch(
  () => props.message,
  (val) => {
    if (val) {
      visible.value = true
      setTimeout(() => {
        visible.value = false
      }, 4000)
    }
  },
  { immediate: true }
)
</script>

<template>
  <transition name="fade">
    <div
      v-if="visible"
      class="fixed top-4 right-4 z-50 px-4 py-2 rounded shadow text-sm font-medium"
      :class="{
        'bg-green-100 text-green-700': type === 'success',
        'bg-red-100 text-red-700': type === 'error',
      }"
    >
      {{ message }}
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>