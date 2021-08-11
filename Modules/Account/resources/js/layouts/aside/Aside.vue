<template>
  <div
    id="kt_aside"
    class="aside aside-hoverable aside-dark"
    data-kt-drawer="true"
    data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}"
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle"
  >
    <div
      id="kt_aside_logo"
      class="aside-logo flex-column-auto"
    >
      <a href="/">
        <img
          alt="Logo"
          src="/dist/img/logo-red.svg"
          class="h-50px logo"
        >
      </a>

      <div
        id="kt_aside_toggle"
        class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
        data-kt-toggle="true"
        data-kt-toggle-state="active"
        data-kt-toggle-target="body"
        data-kt-toggle-name="aside-minimize"
      >
        <span class="svg-icon svg-icon-1 rotate-180">
          <inline-svg
            src="/dist/media/icons/duotone/Navigation/Angle-double-left.svg"
          />
        </span>
      </div>
    </div>

    <div class="aside-menu flex-column-fluid">
      <KTMenu />
    </div>
  </div>
</template>

<script lang="ts">
import {defineComponent, onMounted, onUpdated} from 'vue'
import {DrawerComponent} from '@/metronic/assets/ts/components/_DrawerOptions'
import {ToggleComponent} from '@/metronic/assets/ts/components/_ToggleComponent'
import KTMenu from '@/layouts/aside/Menu.vue'
import {asideTheme} from '@/metronic/core/helpers/config'

export default defineComponent({
  components: {
    KTMenu
  },
  props: {
    lightLogo: {type: String, required: true},
    darkLogo: {type: String, required: true}
  },
  setup() {
    onMounted(() => {
      DrawerComponent.reinitialization()
      ToggleComponent.reinitialization()
    })

    onUpdated(() => {
      ToggleComponent.bootstrap()
    })

    return {asideTheme}
  }
})
</script>
