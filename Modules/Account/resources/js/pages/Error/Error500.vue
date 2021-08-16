<template>
  <div class="pt-lg-10">
    <h1 class="fw-bolder fs-4x text-center text-gray-700 mb-10">
      {{ status }}
    </h1>
    <div class="fw-bold fs-3 text-gray-400 mb-15">
      {{ message }}
    </div>
    <div class="text-center">
      <a href="/" class="btn btn-lg btn-primary fw-bolder">На главную</a>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import AuthLayout from '@/layouts/Auth.vue'

export default defineComponent({
  layout: AuthLayout,
  props: {
    status: {
      type: Number,
      default: 404,
    },
    message: {
      type: String,
      required: true,
    },
  },
})
</script>
