<template>
  <div class="card pb-4">
    <div class="d-flex justify-content-center pt-6 ms-4 mb-7">
      <div class="col-md-3 text-center">
        <div class="form-group">
          <label class="form-label fw-bolder text-dark fs-6">Группа товара*</label>
          <select v-model="group" class="form-control form-control-lg form-control-solid">
            <option v-for="{ id, name } in groups" :key="id" :value="id">
              {{ name }}
            </option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label fw-bolder text-dark fs-6">Категория товара*</label>
          <select v-model="category" class="form-control form-control-lg form-control-solid">
            <option v-for="{ id, name } in categories" :key="id" :value="id">
              {{ name }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div v-if="goods.length" class="card-body py-2">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle text-center gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th>№ в группе</th>
              <th>Код товара</th>
              <th>Наименование</th>
              <th>Наличие</th>
              <th>Заказ</th>
              <th>Цена</th>
              <th>% скидки</th>
              <th>Цена со скидкой</th>
              <th>Вес (брутто)</th>
              <th>Объем</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="(good, index) in goods" :key="good.id">
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
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.stock }}
                </td>
                <td>
                  <input
                    v-model="counts[good.id]"
                    min="0"
                    type="number"
                    class="form-control form-control-sm order-qty-input"
                    :class="{ 'border-danger': counts[good.id] && good.stock === 0 }"
                  />
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.rrp }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.discount }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.salePrice }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.weight }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.volume }}
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center mt-6">
        <button class="btn btn-lg btn-primary" :disabled="disabled" @click="addToCart()">Ввод в заказ</button>
      </div>
      <p v-if="hasOverstock" class="text-danger text-center mt-6">
        Внимание! У вас в заказе товары, которых нет в наличии.
      </p>
    </div>
  </div>
</template>

<script lang="ts">
import { formatDate, Inertia, usePage, useRoute } from 'mixon'
import { computed, defineComponent, ref, watch } from 'vue'
import { Category, Group } from '@/types/goods'
import { serialize } from 'object-to-formdata'

interface Page {
  data: {
    groups: Array<Group>
    group?: number
    categories: Array<Category>
    category?: number
    goods: Array<{
      id: number
      sku: string
      name: string
      stock: number
      rrp: number
      discount: number
      salePrice: number
      weight: number
      volume: number
    }>
  }
}

export default defineComponent({
  setup() {
    const { route } = useRoute()

    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const group = ref(data.value.group ?? null)
    const category = ref(data.value.category ?? null)
    watch([group, category], () => {
      if (group.value) {
        Inertia.get(route('order', { group: group.value, category: category.value }))
      }
    })

    const counts = ref<Record<string, string>>({})
    const disabled = computed(() => !Object.values(counts.value).filter((c) => c).length)

    const hasOverstock = computed(() => {
      for (const id in counts.value) {
        if (counts.value[id] && data.value.goods.find((good) => good.id === parseInt(id))?.stock === 0) {
          return true
        }
      }
      return false
    })

    function addToCart() {
      if (Object.values(counts.value)) {
        const goods = Object.fromEntries(Object.entries(counts.value).filter(([, value]) => +value))
        Inertia.post(route('order.update'), serialize({ goods }), { preserveState: false })
      }
    }

    return {
      groups: data.value.groups,
      group,
      categories: data.value.categories,
      category,
      goods: data.value.goods,
      counts,
      disabled,
      hasOverstock,
      addToCart,
      route,
      formatDate,
    }
  },
})
</script>

<style scoped>
.table-responsive {
  max-height: 60vh;
}

.order-qty-input {
  max-width: 75px;
}
</style>
