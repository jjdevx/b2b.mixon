<template>
  <div
    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold py-4 fs-6 w-275px"
    data-kt-menu="true"
  >
    <div
      v-if="user"
      class="menu-item px-3"
    >
      <div class="menu-content d-flex align-items-center px-3">
        <div class="symbol symbol-50px me-5">
          <img
            alt="Logo"
            src="dist/media/avatars/150-26.jpg"
          >
        </div>
        <div class="d-flex flex-column">
          <div class="fw-bolder d-flex align-items-center fs-5">
            {{ user.name }}
          </div>
          <a
            href="#"
            class="fw-bold text-muted text-hover-primary fs-7"
          > {{ user.email }}</a>
        </div>
      </div>
    </div>
    <div class="separator my-2" />
    <div class="menu-item px-5">
      <InertiaLink
        href="/"
        class="menu-link px-5"
      >
        Мой профиль
      </InertiaLink>
    </div>
    <div class="menu-item px-5">
      <a
        class="menu-link px-5"
        @click="logout()"
      >
        Выйти
      </a>
    </div>
  </div>
</template>

<script lang="ts">
import {computed, defineComponent} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {useStore} from '@/store'

export default defineComponent({
  components: {},
  setup() {
    const store = useStore()

    const user = computed(() => store.state.common?.auth)

    function logout() {
      Inertia.delete('/logout')
    }

    return {user, logout}
  }
})
</script>
