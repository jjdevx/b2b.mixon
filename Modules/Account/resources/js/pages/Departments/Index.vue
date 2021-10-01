<template>
  <div class="card pb-4">
    <div class="d-flex justify-content-end align-items-center pt-3 pe-3 mb-3">
      <InertiaLink
        v-if="!isTrash && can('departments.trash')"
        :href="route('departments.trash')"
        class="add-department-btn btn btn-sm btn-light-danger me-2"
      >
        <span class="svg-icon svg-icon-2">
          <inline-svg src="/dist/media/icons/duotone/Home/Trash.svg" />
        </span>
        Корзина
      </InertiaLink>
      <InertiaLink
        v-else
        :href="route('departments.index')"
        class="add-department-btn btn btn-sm btn-light-success me-2"
      >
        <span class="svg-icon svg-icon-2">
          <inline-svg src="/dist/media/icons/duotone/Home/Building.svg" />
        </span>
        Активные
      </InertiaLink>
      <InertiaLink
        v-if="can('departments.create')"
        :href="route('departments.create')"
        class="add-department-btn btn btn-sm btn-light-primary"
      >
        <span class="svg-icon svg-icon-2">
          <inline-svg src="/dist/media/icons/duotone/Navigation/Plus.svg" />
        </span>
        Добавить
      </InertiaLink>
    </div>
    <h3 class="card-title align-items-start flex-column ps-4">
      <span class="card-label fw-bolder fs-3 mb-1">Филиалы</span>
    </h3>
    <div class="card-body py-2">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th />
              <th>Название</th>
              <th>Добавлен</th>
              <th>Отредактирован</th>
              <th>Работники</th>
              <th class="min-w-150px text-end">Действия</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(department, index) in branches" :key="index">
              <tr>
                <td>
                  <span class="text-dark fw-bolder text-hover-primary fs-6">{{ department.id }}</span>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ department.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.createdAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.updatedAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  <InertiaLink v-for="({ id, name }, i) in department.users" :key="id" :href="route('users.edit', id)">
                    {{ `${name}${i !== department.users.length - 1 ? ', ' : ''}` }}
                  </InertiaLink>
                </td>
                <td class="text-end">
                  <InertiaLink
                    v-if="can('departments.edit')"
                    :href="route('departments.edit', department.id)"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Communication/Write.svg" />
                    </span>
                  </InertiaLink>
                  <a
                    v-if="can('departments.delete')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="destroy(department.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Trash.svg" />
                    </span>
                  </a>
                  <a
                    v-if="isTrash && can('departments.restore')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Восстановить"
                    @click.prevent="restore(department.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Shield-check.svg" />
                    </span>
                  </a>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
    <h3 class="card-title align-items-start flex-column ps-4">
      <span class="card-label fw-bolder fs-3 mb-1">Отделы Продаж</span>
    </h3>
    <div class="card-body py-2">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th />
              <th>Название</th>
              <th>Добавлен</th>
              <th>Отредактирован</th>
              <th>Работники</th>
              <th class="min-w-150px text-end">Действия</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(department, index) in offices" :key="index">
              <tr>
                <td>
                  <span class="text-dark fw-bolder text-hover-primary fs-6">{{ department.id }}</span>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ department.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.createdAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.updatedAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  <InertiaLink v-for="({ id, name }, i) in department.users" :key="id" :href="route('users.edit', id)">
                    {{ `${name}${i !== department.users.length - 1 ? ', ' : ''}` }}
                  </InertiaLink>
                </td>
                <td class="text-end">
                  <InertiaLink
                    v-if="can('departments.edit')"
                    :href="route('departments.edit', department.id)"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Communication/Write.svg" />
                    </span>
                  </InertiaLink>
                  <a
                    v-if="can('departments.delete')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="destroy(department.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Trash.svg" />
                    </span>
                  </a>
                  <a
                    v-if="isTrash && can('departments.restore')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Восстановить"
                    @click.prevent="restore(department.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Shield-check.svg" />
                    </span>
                  </a>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
    <h3 class="card-title align-items-start flex-column ps-4">
      <span class="card-label fw-bolder fs-3 mb-1">Магазины</span>
    </h3>
    <div class="card-body py-2">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th />
              <th>Название</th>
              <th>Добавлен</th>
              <th>Отредактирован</th>
              <th>Работники</th>
              <th class="min-w-150px text-end">Действия</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(department, index) in shops" :key="index">
              <tr>
                <td>
                  <span class="text-dark fw-bolder text-hover-primary fs-6">{{ department.id }}</span>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ department.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.createdAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.updatedAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  <InertiaLink v-for="({ id, name }, i) in department.users" :key="id" :href="route('users.edit', id)">
                    {{ `${name}${i !== department.users.length - 1 ? ', ' : ''}` }}
                  </InertiaLink>
                </td>
                <td class="text-end">
                  <InertiaLink
                    v-if="can('departments.edit')"
                    :href="route('departments.edit', department.id)"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Communication/Write.svg" />
                    </span>
                  </InertiaLink>
                  <a
                    v-if="can('departments.delete')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="destroy(department.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Trash.svg" />
                    </span>
                  </a>
                  <a
                    v-if="isTrash && can('departments.restore')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Восстановить"
                    @click.prevent="restore(department.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Shield-check.svg" />
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
import { useRoute, useCan, usePage, Inertia, Swal, formatDate } from 'mixon'
import { computed, defineComponent, onMounted } from 'vue'
import { Tooltip } from 'bootstrap'
import { DepartmentType, Department } from '@/types/departments'

type DepartmentWithUsers = Omit<Department, 'users'> & {
  users: Array<{ id: number; name: string }>
}

interface Page {
  data: Record<DepartmentType, Array<DepartmentWithUsers>>
}

export default defineComponent({
  setup() {
    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const { route, routeIncludes } = useRoute()

    const isTrash = routeIncludes('trash')

    async function destroy(id: number) {
      const { isConfirmed } = await Swal.fire({
        title: `Вы уверены, что хотите удалить отдел${isTrash ? ' окончательно' : ''}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да!',
        cancelButtonText: 'Отменить',
      })
      if (isConfirmed) {
        Inertia.delete(route(`departments.${!isTrash ? 'destroy' : 'forceDestroy'}`, id), {
          preserveState: false,
          replace: true,
        })
      }
    }

    async function restore(id: number) {
      const { isConfirmed } = await Swal.fire({
        title: 'Вы уверены, что хотите восстановить отдел?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да!',
        cancelButtonText: 'Отменить',
      })
      if (isConfirmed) {
        Inertia.post(
          route(`departments.restore`, id),
          {},
          {
            preserveState: false,
            replace: true,
          }
        )
      }
    }

    const handleSizeChange = (size: number) => Inertia.get('', { perPage: size })
    const handleCurrentChange = (page: number) => Inertia.get('', { page }, { preserveScroll: true })

    onMounted(() => {
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl)
      })
    })

    return {
      branches: data.value.branch,
      offices: data.value.office,
      shops: data.value.shop,
      isTrash,
      destroy,
      restore,
      handleSizeChange,
      handleCurrentChange,
      route,
      ...useCan(),
      formatDate,
    }
  },
})
</script>
