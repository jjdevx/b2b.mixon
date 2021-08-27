<template>
  <div class="card pb-4">
    <div v-if="goods.length" class="card-body py-2">
      <h1 class="text-center my-8">Корзина</h1>
      <div class="table-responsive table-hover">
        <table
          class="table table-row-bordered table-row-gray-100 align-middle text-center gs-0 gy-3"
        >
          <thead>
            <tr class="fw-bolder text-muted">
              <th>ID</th>
              <th>Код товара</th>
              <th>Наименование</th>
              <th>Цена</th>
              <th>Вес (брутто)</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="good in goods" :key="good.id">
              <tr>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.id }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.sku }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.name }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.price }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.weight }}
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center">
        <button class="btn btn-lg btn-warning" @click="clearCart()">Очистить корзину</button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Inertia, usePage, useRoute } from 'mixon'
import { computed, defineComponent } from 'vue'

interface Page {
  data: {
    goods: Array<{
      id: number
      sku: string
      name: string
      price: number
      weight: number
    }>
  }
}

export default defineComponent({
  setup() {
    const { route } = useRoute()

    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const clearCart = () => Inertia.delete(route('cart.clear'))

    return {
      goods: data.value.goods,
      clearCart,
    }
  },
})
</script>
