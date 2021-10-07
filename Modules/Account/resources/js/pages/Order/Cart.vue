<template>
  <div class="card pb-4">
    <div v-if="data.goods.length" class="card-body py-2">
      <h1 class="text-center my-8">Корзина</h1>
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle text-center gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th>ID</th>
              <th>Код товара</th>
              <th>Наименование</th>
              <th class="min-w-125px">Количество</th>
              <th>Цена</th>
              <th>% скидки</th>
              <th>Цена со скидкой</th>
              <th>Всего</th>
              <th>Вес (брутто)</th>
              <th>Объем</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <template v-for="good in data.goods" :key="good.id">
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
                  <a
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="changeQty(good.row, false)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Code/Minus.svg" />
                    </span>
                  </a>
                  {{ good.qty }}
                  <a
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="changeQty(good.row)"
                  >
                    <span class="svg-icon svg-icon-3">
                      <inline-svg src="/dist/media/icons/duotone/Code/Plus.svg" />
                    </span>
                  </a>
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.price }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.discount }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.salePrice }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.total }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.weight }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.volume }}
                </td>
                <td class="text-end">
                  <a
                    href="#"
                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                    @click.prevent="remove(good.row)"
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
      <div class="d-flex flex-wrap">
        <button class="btn btn-lg btn-warning me-3" @click="clearCart()">Очистить корзину</button>
        <a :href="route('cart.excel')" class="btn btn-lg btn-success">Excel</a>
      </div>
      <div class="d-flex justify-content-between align-items-center mt-6">
        <form class="cart_form" @submit.prevent="submit()">
          <div class="mb-3">
            <label for="billing" class="form-label">Форма расчета</label>
            <select id="billing" v-model="form.billing" class="form-select">
              <option v-for="(text, value) in data.billing" :key="value" :value="value">{{ text }}</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Тип заказа</label>
            <select id="type" v-model="form.type" class="form-select">
              <option v-for="(text, value) in data.types" :key="value" :value="value">{{ text }}</option>
            </select>
          </div>
          <div class="mb-3">
            <textarea v-model="form.comment" class="form-control" rows="5">Примечание</textarea>
          </div>
          <button class="btn btn-primary btn-lg">Заказать</button>
        </form>
        <table class="cart_table table table-row-bordered table-sm">
          <tbody>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Общее количество, ед.:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ data.qty }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Cумма(РРЦ) UAH:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ data.rrp }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Ваша стоимость (фактическая стоимость):</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ data.total }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Общий вес, кг.:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ data.weight }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Общий объем, м².:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ data.volume }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <h1 v-else class="text-center my-8">Корзина пуста</h1>
  </div>
</template>

<script lang="ts">
import { Inertia, usePage, useRoute } from 'mixon'
import { computed, defineComponent, reactive } from 'vue'

interface Page {
  data: {
    goods: Array<{
      id: number
      row: number
      sku: string
      name: string
      qty: number
      stock: number
      price: number
      discount: number
      salePrice: number
      total: number
      weight: number
      volume: number
    }>
    billing: Record<string, string>
    types: Record<string, string>
    rrp: number
    total: number
    qty: number
    weight: number
    volume: number
  }
}

export default defineComponent({
  setup() {
    const { route } = useRoute()

    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const clearCart = () => Inertia.delete(route('cart.clear'))

    function changeQty(row: number, plus = true) {
      Inertia.post(route(`cart.${plus ? 'plus' : 'minus'}`, row), { preserveState: false })
    }

    const remove = (row: number) => Inertia.delete(route('cart.remove', row), { preserveState: false })

    const form = reactive({ billing: 'CASH', type: 'CURRENT', comment: '' })

    function submit() {
      Inertia.post(route('order.create', { ...form }))
    }

    return {
      data,
      clearCart,
      changeQty,
      remove,
      form,
      submit,
      route,
    }
  },
})
</script>

<style lang="scss">
.cart_form {
  width: 100%;
  max-width: 400px;
}

.cart_table {
  max-width: 250px;
}
</style>
