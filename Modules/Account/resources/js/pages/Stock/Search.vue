<template>
  <div class="card pb-4">
    <div class="d-flex justify-content-around pt-6 ms-4 mb-7">
      <form @submit.prevent="search(searchBy.sku)">
        <label class="form-label fw-bolder text-dark fs-6">Введите код</label>
        <input v-model="sku" class="form-control form-control-lg form-control-solid mb-3" />
        <button class="btn btn-success d-block mx-auto mb-7" :disabled="!sku.length">Искать</button>
      </form>
      <form @submit.prevent="search(searchBy.name)">
        <label class="form-label fw-bolder text-dark fs-6">Поиск кода по части названия</label>
        <input v-model="name" class="form-control form-control-lg form-control-solid mb-3" />
        <button class="btn btn-success d-block mx-auto mb-7" :disabled="!name.length">
          Искать
        </button>
      </form>
    </div>
    <div v-if="goodsBySku.length || goodsByName.length" class="card-body py-2">
      <div class="table-responsive table-hover">
        <table
          v-if="goodsBySku.length"
          class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
        >
          <thead>
            <tr class="fw-bolder text-muted">
              <th>Филиал</th>
              <th>Дата</th>
              <th>Код товара</th>
              <th>Наименование</th>
              <th>Количество</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="department in goodsBySku" :key="department.id">
              <tr>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ department.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ formatDate(department.date, 'YYYY-MM-DD, HH:ss') }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ department.sku }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ department.good }}
                </td>
                <td
                  class="text-dark fw-bolder text-hover-primary fs-6"
                  :class="{ 'text-danger': department.stock === 0 }"
                >
                  {{ department.stock }}
                </td>
              </tr>
            </template>
          </tbody>
        </table>
        <table
          v-if="goodsByName.length"
          class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3"
        >
          <thead>
            <tr class="fw-bolder text-muted">
              <th>Код товара</th>
              <th>Наименование</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="good in goodsByName" :key="good.id">
              <tr>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.sku }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.name }}
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
import { formatDate, Inertia, usePage, useRoute } from 'mixon'
import { computed, defineComponent, ref } from 'vue'

interface Page {
  data: {
    sku?: string
    goodsBySku: Array<{
      id: number
      name: string
      date: string
      sku: string
      good: string
      stock: number
    }>
    name?: string
    goodsByName: Array<{ id: number; name: string; sku: number }>
  }
}

enum searchBy {
  sku = 'sku',
  name = 'name',
}

export default defineComponent({
  setup() {
    const { route } = useRoute()

    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const sku = ref(data.value.sku ?? '')
    const name = ref(data.value.name ?? '')

    function search(by: searchBy) {
      const params: Partial<Record<searchBy, string>> = {}

      if (by === 'sku' && sku.value) {
        params.sku = sku.value
        name.value = ''
      } else if (by === 'name' && name.value) {
        params.name = name.value
        sku.value = ''
      }

      if (Object.keys(params).length) {
        Inertia.get(route('stock.search', params))
      }
    }

    return {
      sku,
      goodsBySku: data.value.goodsBySku,
      name,
      goodsByName: data.value.goodsByName,
      search,
      searchBy,
      route,
      formatDate,
    }
  },
})
</script>
