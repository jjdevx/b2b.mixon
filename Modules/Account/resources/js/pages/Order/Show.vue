<template>
  <div class="card pb-4">
    <div class="card-body py-2">
      <h1 class="text-center my-8">
        On-Line заказ № {{ order.id }} от {{ formatDate(order.createdAt, 'YYYY-MM-DD, HH:ss') }}
      </h1>
      <div class="d-flex justify-content-between mt-6">
        <table class="cart_table table table-row-bordered table-sm">
          <tbody>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.company }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.country }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.city }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.address }}</td>
            </tr>
          </tbody>
        </table>
        <table class="cart_table table table-row-bordered table-sm">
          <tbody>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.phone }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.fax }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.user.email }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
              <th>ID</th>
              <th>Код товара</th>
              <th>Наименование</th>
              <th class="min-w-125px">Количество</th>
              <th>Цена</th>
              <th>Вес (брутто)</th>
              <th>Объем</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="good in order.goods" :key="good.id">
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
                  {{ good.pivot.qty }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.pivot.price }}
                </td>

                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.pivot.weight }}
                </td>
                <td class="text-dark fw-bolder text-hover-primary fs-6">
                  {{ good.pivot.volume }}
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-between align-items-center mt-6">
        <table class="cart_table table table-row-bordered table-sm">
          <tbody>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Форма расчета:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.billing }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Тип заказа:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.type }}</td>
            </tr>
          </tbody>
        </table>
        <table class="cart_table table table-row-bordered table-sm">
          <tbody>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Общее количество, ед.:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.qty }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Cумма UAH:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.total }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Общий вес, кг.:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.weight }}</td>
            </tr>
            <tr>
              <td class="text-dark fw-bolder text-hover-primary fs-6">Общий объем, м².:</td>
              <td class="text-dark fw-bolder text-hover-primary fs-6">{{ order.volume }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <p><b>Примечание: </b>{{ order.comment }}</p>
    </div>
  </div>
</template>

<script lang="ts">
import { formatDate, usePage } from 'mixon'
import { computed, defineComponent } from 'vue'

interface Page {
  data: {
    order: {
      id: number
      user: {
        company: string
        country: string
        city: string
        address: string
        phone: string
        fax: string
        email: string
      }
      billing: string
      type: string
      comment: string
      goods: Array<{
        id: number
        row: number
        sku: string
        name: string
        pivot: {
          qty: number
          price: number
          weight: number
          volume: number
        }
      }>
      total: number
      qty: number
      weight: number
      volume: number
      createdAt: string
    }
  }
}

export default defineComponent({
  setup() {
    const page = usePage<Page>()
    const order = computed(() => page.props.value.data.order)

    return {
      order,
      formatDate,
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
