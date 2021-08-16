<template>
  <div
    class="
      auth-layout
      d-flex
      flex-column flex-column-fluid
      bgi-position-y-bottom
      position-x-center
      bgi-no-repeat bgi-size-contain bgi-attachment-fixed
    "
    style="background-image: url('/dist/media/illustrations/progress-hd.png')"
  >
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
      <a href="#" class="mb-12">
        <img alt="Logo" src="/dist/img/logo-start.svg" class="h-45px" />
      </a>

      <div class="w-lg-500px bg-white rounded p-10 p-lg-15 mx-auto">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({})
</script>

<style scoped>
.auth-layout {
  min-height: 100vh;
}
</style>
