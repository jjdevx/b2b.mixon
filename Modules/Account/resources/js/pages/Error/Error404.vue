<template>
  <div class="pt-lg-8">
    <h1 class="fw-bolder fs-5x text-center">
      {{ status }}
    </h1>
    <h2 class="fw-bolder fs-2x text-center text-gray-700 mb-10">
      {{ message }}
    </h2>
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
