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
        <a
          href="#"
          class="add-user-btn btn btn-sm btn-light-primary"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="dist/media/icons/duotone/Communication/Add-user.svg" />
          </span>
          Добавить
        </a>
        <form
          class="input-group"
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
                Компания
              </th>
              <th class="min-w-100px">
                ОКПО
              </th>
              <th class="min-w-150px">
                Страна
              </th>
              <th class="min-w-150px">
                Город
              </th>
              <th class="min-w-150px">
                Адрес
              </th>
              <th class="min-w-150px">
                Факс
              </th>
              <th class="min-w-150px">
                Телефон
              </th>
              <th class="min-w-150px text-end">
                Действия
              </th>
            </tr>
          </thead>
          <tbody>
            <template
              v-for="(item, index) in paginator.collection"
              :key="index"
            >
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                      <span class="symbol-label bg-light">
                        <img
                          :src="item.icon"
                          class="w-100 align-self-end"
                        >
                      </span>
                    </div>
                    <span class="text-dark fw-bolder text-hover-primary fs-6">{{ item.id }}</span>
                  </div>
                </td>

                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ `${item.surname} ${item.name}` }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.email }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.company }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.okpo }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.country }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.city }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.address }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.fax }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ item.phone }}
                </td>

                <td class="text-end">
                  <a
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="dist/media/icons/duotone/Communication/Write.svg" />
                    </span>
                  </a>
                  <a
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                  >
                    <span
                      class="svg-icon svg-icon-3"
                      @click="destroy(item.id)"
                    >
                      <inline-svg src="dist/media/icons/duotone/General/Trash.svg" />
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
import {computed, defineComponent, onMounted, ref} from 'vue'
import {route} from 'mixon'
import Layout from '@/layouts/Layout.vue'
import {ElPagination} from 'element-plus'
import {setCurrentPageTitle} from '@/metronic/core/helpers/breadcrumb'
import {usePage} from '@inertiajs/inertia-vue3'
import {Inertia} from '@inertiajs/inertia'
import Swal from 'sweetalert2'

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
  layout: Layout,
  setup() {
    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

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
        title: 'Вы уверены?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Да!',
        cancelButtonText: 'Отменить'
      })
      if (isConfirmed) {
        Inertia.delete(route('users.destroy', id), {
          preserveState: false,
          replace: true
        })
      }
    }

    const handleSizeChange = (size: number) => Inertia.get('', {perPage: size})
    const handleCurrentChange = (page: number) => Inertia.get('', {page}, {preserveScroll: true})

    onMounted(() => setCurrentPageTitle('Пользователи'))

    return {
      paginator: data.value.paginator,
      sortBy, sortDesc, sort,
      searchQuery, search,
      destroy,
      handleSizeChange, handleCurrentChange
    }
  }
})
</script>

<style scoped>
.add-user-btn {
  height: 42.5px;
  width: 160px;
  display: flex;
  align-items: center;
  margin-right: 15px;
}
</style>
