<template>
  <div class="card pb-4">
    <div class="card-header align-items-center border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">Пользователи</span>

        <span
          class="text-muted mt-1 fw-bold fs-7"
        >Количество: {{ paginator.total }}</span>
      </h3>
      <div class="d-flex align-items-center">
        <InertiaLink
          v-if="!isTrash && can('users.trash')"
          :href="route('users.trash')"
          class="add-user-btn btn btn-sm btn-light-danger"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Home/Trash.svg" />
          </span>
          Корзина
        </InertiaLink>
        <InertiaLink
          v-else
          :href="route('users.index')"
          class="add-user-btn btn btn-sm btn-light-success"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/General/User.svg" />
          </span>
          Активные
        </InertiaLink>
        <InertiaLink
          v-if="can('users.create')"
          :href="route('users.create')"
          class="add-user-btn btn btn-sm btn-light-primary"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Communication/Add-user.svg" />
          </span>
          Добавить
        </InertiaLink>
        <form
          class="input-group w-50"
          @submit.prevent="search()"
        >
          <input
            v-model="searchQuery"
            type="search"
            class="form-control form-control-solid"
            placeholder="Поиск"
          >
          <button class="btn btn-sm btn-light-primary">
            <i class="fas fa-search" />
          </button>
        </form>
      </div>
    </div>
    <div class="card-body py-3">
      <div class="table-responsive table-hover">
        <table
          class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
        >
          <thead>
            <tr class="fw-bolder text-muted">
              <th
                class="min-w-125px"
                @click="sort('id')"
              />
              <th
                class="min-w-125px"
                @click="sort('name')"
              >
                Имя
              </th>
              <th
                class="min-w-125px"
                @click="sort('email')"
              >
                Почта
              </th>
              <th class="min-w-150px">
                Компания и ОКПО
              </th>
              <th class="min-w-150px">
                Локация
              </th>
              <th class="min-w-150px">
                Телефон и факс
              </th>
              <th class="min-w-125px">
                Роль
              </th>
              <th class="min-w-150px text-end">
                Действия
              </th>
            </tr>
          </thead>
          <tbody>
            <template
              v-for="(user, index) in paginator.collection"
              :key="index"
            >
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                      <span class="symbol-label bg-light">
                        <img
                          :src="user.icon"
                          class="w-100 align-self-end"
                        >
                      </span>
                    </div>
                    <span class="text-dark fw-bolder text-hover-primary fs-6">{{ user.id }}</span>
                  </div>
                </td>

                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ `${user.surname} ${user.name}` }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ user.email }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ user.company }}
                  <p>{{ user.okpo }}</p>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ user.country }}
                  <p>{{ user.city }}</p>
                  <p>{{ user.address }}</p>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ user.phone }}
                  <p> {{ user.fax }}</p>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ user.roles.join(', ') }}
                </td>

                <td class="text-end">
                  <InertiaLink
                    v-if="can('users.edit')"
                    :href="route('users.edit',user.id)"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Communication/Write.svg" />
                    </span>
                  </InertiaLink>
                  <a
                    v-if="can('users.delete')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="destroy(user.id)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/General/Trash.svg" />
                    </span>
                  </a>
                  <a
                    v-if="isTrash && can('users.restore')"
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    title="Восстановить"
                    @click.prevent="restore(user.id)"
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
    <div class="d-flex justify-content-center">
      <ElPagination
        :current-page="paginator.currentPage"
        :page-sizes="[10, 20, 50, 100]"
        :page-size="paginator.perPage"
        layout="total, sizes, prev, pager, next, jumper"
        :total="paginator.total"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      />
    </div>
  </div>
</template>

<script lang="ts">
import {useRoute, useCan, usePage, Inertia, Swal} from 'mixon'
import {computed, defineComponent, onMounted, ref} from 'vue'
import {ElPagination} from 'element-plus'
import {Tooltip} from 'bootstrap'

interface Page {
  data: {
    paginator: Paginator<User>
    table: {
      searchQuery: string
      sortBy: string
      sortDesc: number
    }
  }
}

interface Paginator<T> {
  collection: Array<T>
  total: number
  lastPage: number
  perPage: number
  currentPage: number
}

interface User {
  id: number
  icon: string
  name: string
  surname: string
  email: string
  emailVerified: boolean
  company: string
  okpo: number
  country: string
  city: string
  address: string
  fax: string
  phone: string
  roles: Array<string>
}

export default defineComponent({
  components: {ElPagination},
  setup() {
    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const {route, routeIncludes} = useRoute()

    const isTrash = routeIncludes('trash')

    const searchQuery = ref(data.value.table.searchQuery ?? '')
    const search = () => Inertia.get('', {searchQuery: searchQuery.value}, {preserveScroll: true})

    const sortBy = ref(data.value.table.sortBy ?? '')
    const sortDesc = ref(data.value.table.sortDesc ?? '')

    function sort(field: string) {
      Inertia.get('', {
        sortBy: field,
        sortDesc: sortBy.value === field ? (sortDesc.value ? 0 : 1) : 0
      }, {preserveScroll: true})
    }

    async function destroy(id: number) {
      const {isConfirmed} = await Swal.fire({
        title: `Вы уверены, что хотите удалить пользователя${isTrash ? ' окончательно' : ''}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да!',
        cancelButtonText: 'Отменить'
      })
      if (isConfirmed) {
        Inertia.delete(route(`users.${!isTrash ? 'destroy' : 'forceDestroy'}`, id), {
          preserveState: false,
          replace: true
        })
      }
    }

    async function restore(id: number) {
      const {isConfirmed} = await Swal.fire({
        title: 'Вы уверены, что хотите восстановить пользователя?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да!',
        cancelButtonText: 'Отменить'
      })
      if (isConfirmed) {
        Inertia.post(route(`users.restore`, id), {}, {
          preserveState: false,
          replace: true
        })
      }
    }

    const handleSizeChange = (size: number) => Inertia.get('', {perPage: size})
    const handleCurrentChange = (page: number) => Inertia.get('', {page}, {preserveScroll: true})

    onMounted(() => {
      const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl)
      })
    })

    return {
      paginator: data.value.paginator,
      isTrash,
      sortBy, sortDesc, sort,
      searchQuery, search,
      destroy, restore,
      handleSizeChange, handleCurrentChange,
      route, ...useCan()
    }
  }
})
</script>

<style scoped>
.add-user-btn {
  height: 42.5px;
  display: flex;
  align-items: center;
  margin-right: 15px;
}
</style>
