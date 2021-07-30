<template>
  <div
    id="kt_header"
    class="header align-items-stretch"
  >
    <div
      :class="{
        'container-fluid': headerWidthFluid,
        container: !headerWidthFluid
      }"
      class="d-flex align-items-stretch justify-content-between"
    >
      <div
        class="d-flex align-items-center d-lg-none ms-n3 me-1"
        title="Show aside menu"
      >
        <div
          id="kt_aside_mobile_toggle"
          class="btn btn-icon btn-active-light-primary"
        >
          <span class="svg-icon svg-icon-2x mt-1">
            <inline-svg src="dist/media/icons/duotone/Text/Menu.svg" />
          </span>
        </div>
      </div>
      <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
        <a
          href="/"
          class="d-lg-none"
        >
          <img
            alt="Logo"
            src="dist/img/logo-start.svg"
            class="h-30px"
          >
        </a>
      </div>
      <div
        class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
      >
        <div
          id="kt_header_menu_nav"
          class="d-flex align-items-stretch"
        >
          <KTMenu />
        </div>
        <div class="d-flex align-items-stretch flex-shrink-0">
          <KTTopbar />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent} from 'vue'
import KTTopbar from '@/layouts/Header/Topbar.vue'
import KTMenu from '@/layouts/Header/Menu.vue'

import {
  headerWidthFluid,
  headerLeft,
  asideDisplay
} from '@/metronic/core/helpers/config'

export default defineComponent({
  name: 'KTHeader',
  components: {
    KTTopbar,
    KTMenu
  },
  props: {
    title: {type: String, required: true}
  },
  setup() {
    return {
      headerWidthFluid,
      headerLeft,
      asideDisplay
    }
  }
})
</script>
