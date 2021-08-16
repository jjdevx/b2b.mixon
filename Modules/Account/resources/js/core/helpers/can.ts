import { computed } from 'vue'
import { useStore } from '@/store'

export function useCan() {
  const store = useStore()

  const user = computed(() => store.state.common?.auth)

  function can(...permissions): boolean {
    return user.value ? user.value.permissions.some((p) => permissions.indexOf(p) >= 0) : false
  }

  return { can }
}
