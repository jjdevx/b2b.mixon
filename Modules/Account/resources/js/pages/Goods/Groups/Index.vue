<template>
  <div class="card pb-4">
    <div class="d-flex justify-content-end align-items-center pt-3 pe-3 mb-3">
      <InertiaLink
        v-if="can('groups.create')"
        :href="route('groups.create')"
        class="add-group-btn btn btn-sm btn-light-primary"
      >
        <span class="svg-icon svg-icon-2">
          <inline-svg src="/dist/media/icons/duotone/Navigation/Plus.svg" />
        </span>
        Добавить
      </InertiaLink>
    </div>
    <h3 class="card-title align-items-start flex-column ps-4">
      <span class="card-label fw-bolder fs-3 mb-1">Направления</span>
    </h3>
    <div class="card-body py-2">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th />
              <th>Название</th>
              <th>Добавлена</th>
              <th>Отредактирована</th>
              <th class="min-w-150px text-end">Действия</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(group, index) in groups" :key="index">
              <tr>
                <td>
                  <span class="text-dark fw-bolder text-hover-primary fs-6">{{ group.id }}</span>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ group.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(group.createdAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(group.updatedAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-end">
                  <InertiaLink
                    v-if="can('groups.edit')"
                    :href="route('groups.edit', group.id)"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Communication/Write.svg" />
                    </span>
                  </InertiaLink>
                  <a
                    v-if="can('groups.delete')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="destroy(group.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Trash.svg" />
                    </span>
                  </a>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { formatDate, Inertia, Swal, useCan, usePage, useRoute } from 'mixon'
import { computed, defineComponent } from 'vue'
import { Group } from '@/types/goods'

interface Page {
  data: {
    groups: Array<Group>
  }
}

export default defineComponent({
  setup() {
    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const { route } = useRoute()

    async function destroy(id: number) {
      const { isConfirmed } = await Swal.fire({
        title: `Вы уверены, что хотите удалить группу?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да!',
        cancelButtonText: 'Отменить',
      })
      if (isConfirmed) {
        Inertia.delete(route(`groups.destroy`, id), {
          preserveState: false,
          replace: true,
        })
      }
    }

    return {
      groups: data.value.groups,
      destroy,
      route,
      ...useCan(),
      formatDate,
    }
  },
})
</script>
