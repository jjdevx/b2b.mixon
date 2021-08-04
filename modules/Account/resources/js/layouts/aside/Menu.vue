<template>
  <div
    id="kt_aside_menu_wrapper"
    ref="scrollElRef"
    class="hover-scroll-overlay-y my-5 my-lg-5"
    data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}"
    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
    data-kt-scroll-height="auto"
    data-kt-scroll-offset="0"
    data-kt-scroll-wrappers="#kt_aside_menu"
  >
    <div
      v-if="menu"
      id="#kt_header_menu"
      class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
      data-kt-menu="true"
    >
      <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
          <span
            class="menu-section text-muted text-uppercase fs-8 ls-1"
          >Аккаунт</span>
        </div>
      </div>
      <div
        v-for="item in menu"
        :key="item.link"
        class="menu-item"
      >
        <InertiaLink
          :href="item.link"
          class="menu-link"
          :class="{active: item.active}"
        >
          <span class="menu-icon">
            <span class="svg-icon svg-icon-2">
              <inline-svg :src="`/dist/media/icons/${item.icon}`" />
            </span>
          </span>
          <span class="menu-title">{{ item.title }}</span>
        </InertiaLink>
      </div>
      <div class="menu-item">
        <a
          href="/"
          class="menu-link"
          @click="logout()"
        >
          <span class="menu-icon">
            <span class="svg-icon svg-icon-2">
              <inline-svg src="/dist/media/icons/duotone/Navigation/Sign-out.svg" />
            </span>
          </span>
          <span class="menu-title">Выйти</span>
        </a>
      </div>
      <div class="menu-item">
        <div class="menu-content">
          <div class="separator mx-1 my-4" />
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import {computed, defineComponent, onMounted, ref} from 'vue'
import {ScrollComponent} from '@/metronic/assets/ts/components/_ScrollComponent'
import {MenuComponent} from '@/metronic/assets/ts/components/MenuComponent'
import {Inertia} from '@inertiajs/inertia'
import {useStore} from '@/store'

export default defineComponent({
  name: 'KtMenu',
  components: {},
  setup() {
    const store = useStore()
    const menu = computed(() => store.state.common?.menu)

    const scrollElRef = ref<null | HTMLElement>(null)

    function logout() {
      Inertia.delete('/logout')
    }

    onMounted(() => {
      ScrollComponent.reinitialization()
      MenuComponent.reinitialization()
      if (scrollElRef.value) {
        scrollElRef.value.scrollTop = 0
      }
    })

    return {menu, scrollElRef, logout}
  }
})
</script>

<style lang="scss">
.aside-menu .menu .menu-sub .menu-item a a.menu-link {
  padding-left: calc(0.75rem + 25px);
  cursor: pointer;
  display: flex;
  align-items: center;
  flex: 0 0 100%;
  transition: none;
  outline: none !important;
}

.aside-menu .menu .menu-sub .menu-sub .menu-item a a.menu-link {
  padding-left: calc(1.5rem + 25px);
  cursor: pointer;
  display: flex;
  align-items: center;
  flex: 0 0 100%;
  transition: none;
  outline: none !important;
}
</style>
