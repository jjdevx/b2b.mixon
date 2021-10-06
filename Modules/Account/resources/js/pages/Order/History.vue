<template>
  <div class="card pb-4">
    <div class="card-header align-items-center border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">История заказов</span>

        <span class="text-muted mt-1 fw-bold fs-7">Количество: {{ paginator.total }}</span>
      </h3>
    </div>
    <div class="card-body py-3">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th class="min-w-125px" @click="sort('id')" />
              <th class="min-w-125px">Клиент</th>
              <th class="min-w-150px">Кол-во товаров</th>
              <th class="min-w-150px">Вес</th>
              <th class="min-w-150px">Объем</th>
              <th class="min-w-150px">Дата</th>
              <th class="min-w-150px text-end">Действия</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(order, index) in paginator.collection" :key="index">
              <tr>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ order.id }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ `${order.user.surname} ${order.user.name}` }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ order.qty }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ order.weight }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ order.volume }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(order.createdAt, 'DD.MM.YYYY, HH:ss') }}
                </td>
                <td class="text-end">
                  <InertiaLink :href="route('history.show', order.id)" class="btn btn-success me-1">
                    Просмотреть
                  </InertiaLink>
                  <InertiaLink :href="route('history.repeat', order.id)" class="btn btn-primary">Повторить</InertiaLink>
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
import { formatDate, useRoute, useCan, usePage, Inertia } from 'mixon'
import { computed, defineComponent, onMounted, ref } from 'vue'
import { ElPagination } from 'element-plus'
import { Tooltip } from 'bootstrap'

interface Page {
  data: {
    paginator: Paginator<Order>
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

interface Order {
  id: number
  user: {
    name: string
    surname: string
  }
  qty: number
  weight: number
  volume: number
  createdAt: string
}

export default defineComponent({
  components: { ElPagination },
  setup() {
    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const { route } = useRoute()

    const searchQuery = ref(data.value.table.searchQuery ?? '')
    const search = () => Inertia.get('', { searchQuery: searchQuery.value }, { preserveScroll: true })

    const sortBy = ref(data.value.table.sortBy ?? '')
    const sortDesc = ref(data.value.table.sortDesc ?? '')

    function sort(field: string) {
      Inertia.get(
        '',
        {
          sortBy: field,
          sortDesc: sortBy.value === field ? (sortDesc.value ? 0 : 1) : 0,
        },
        { preserveScroll: true }
      )
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
      paginator: data.value.paginator,
      sortBy,
      sortDesc,
      sort,
      searchQuery,
      search,
      handleSizeChange,
      handleCurrentChange,
      route,
      ...useCan(),
      formatDate,
    }
  },
})
</script>
