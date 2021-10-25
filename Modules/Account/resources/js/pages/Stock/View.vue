<template>
  <div class="card pb-4">
    <div class="d-flex justify-content-center pt-6 ms-4 mb-7">
      <div class="col-md-3 text-center">
        <div class="mb-3">
          <label class="form-label fw-bolder text-dark fs-6">Филиал*</label>
          <select v-model="department" class="form-control form-control-lg form-control-solid">
            <option v-for="{ id, name } in departments" :key="id" :value="id">
              {{ name }}
            </option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label fw-bolder text-dark fs-6">Направление товара*</label>
          <select v-model="group" class="form-control form-control-lg form-control-solid">
            <option v-for="{ id, name } in groups" :key="id" :value="id">
              {{ name }}
            </option>
          </select>
        </div>
        <div>
          <label class="form-label fw-bolder text-dark fs-6">Группа товара*</label>
          <select v-model="category" class="form-control form-control-lg form-control-solid">
            <option v-for="{ id, name } in categories" :key="id" :value="id">
              {{ name }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div v-if="goods.length" class="card-body py-2">
      <h3 v-if="stockLastUpdate" class="text-center">
        Дата обновления данных - {{ formatDate(stockLastUpdate, 'YYYY-MM-DD, HH:ss') }}
      </h3>
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th>№ в группе</th>
              <th>Код товара</th>
              <th>Наименование</th>
              <th>Количество</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(good, index) in goods" :key="index">
              <tr>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ index + 1 }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.sku }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6" :class="{ 'text-danger': good.stock === 0 }">
                  {{ good.stock }}
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
import { computed, defineComponent, onMounted, ref, watch } from 'vue'
import { Group } from '@/types/goods'
import { Department } from '@/types/departments'

interface Page {
  data: {
    departments: Array<Department>
    department?: number
    groups: Array<Group>
    group?: number
    categories: Array<Group>
    category?: number
    goods: Array<{ sku: string; name: string; stock: number }>
    stockLastUpdate: string | null
  }
}

export default defineComponent({
  setup() {
    const { route } = useRoute()

    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const department = ref(data.value.department ?? null)
    const group = ref(data.value.group ?? null)
    const category = ref(data.value.category ?? null)

    watch([group], () => {
      category.value = null
    })

    watch([department, group, category], () => {
      if (department.value && group.value) {
        Inertia.get(
          route('stock.view', {
            department: department.value,
            group: group.value,
            category: category.value,
          })
        )
      }
    })

    onMounted(() => {
      if (department.value === null) {
        department.value = data.value.departments[0].id
      }
    })

    return {
      departments: data.value.departments,
      department,
      groups: data.value.groups,
      group,
      categories: data.value.categories,
      category,
      goods: data.value.goods,
      stockLastUpdate: data.value.stockLastUpdate,
      route,
      formatDate,
    }
  },
})
</script>
