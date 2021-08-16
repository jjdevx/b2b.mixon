<template>
  <div id="kt_footer" class="footer py-4 d-flex flex-lg-column">
    <div
      class="d-flex flex-column flex-md-row align-items-center justify-content-between"
      :class="{
        'container-fluid': footerWidthFluid,
        container: !footerWidthFluid,
      }"
    >
      <div class="text-dark order-2 order-md-1">
        <span class="text-muted fw-bold me-1">{{ year }}&copy;</span>
        <a href="https://raxkor.com/" target="_blank" class="text-gray-800 text-hover-primary">
          Raxkor
        </a>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { footerWidthFluid } from '@/metronic/core/helpers/config'

export default defineComponent({
  setup() {
    return {
      footerWidthFluid,
      year: new Date().getFullYear(),
    }
  },
})
</script>
