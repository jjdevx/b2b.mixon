<template>
  <div class="d-flex align-items-stretch flex-shrink-0">
    <div id="kt_header_user_menu_toggle" class="d-flex align-items-center ms-1 ms-lg-3">
      <div
        class="cursor-pointer symbol symbol-30px symbol-md-40px"
        data-kt-menu-trigger="click"
        data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end"
        data-kt-menu-flip="bottom"
      >
        <img :src="icon" />
      </div>
      <KTUserMenu />
    </div>
    <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
      <div id="kt_header_menu_mobile_toggle" class="btn btn-icon btn-active-light-primary">
        <span class="svg-icon svg-icon-1">
          <inline-svg src="/dist/media/icons/duotone/Text/Toggle-Right.svg" />
        </span>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { computed, defineComponent } from 'vue'
import KTUserMenu from '@/layouts/header/partials/UserMenu.vue'
import { useStore } from '@/store'

export default defineComponent({
  components: {
    KTUserMenu,
  },
  setup() {
    const store = useStore()

    const icon = computed(() => store.state.common?.auth.icon)

    return { icon }
  },
})
</script>
