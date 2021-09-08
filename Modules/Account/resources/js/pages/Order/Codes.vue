<template>
  <div class="card w-lg-500px mx-auto mb-5 mb-xl-10">
    <form id="kt_account_profile_details_form" class="form" novalidate @submit.prevent="submit">
      <div class="card-body border-top p-9">
        <h1 class="mb-8">Заказ по кодам</h1>
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Файл*</label>
          <input
            ref="fileInput"
            class="form-control"
            type="file"
            accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            @change="(e) => handleFileChange(e)"
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.excel }}
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <button type="submit" class="btn btn-primary">
          Загрузить
          <span v-if="isLoading" class="spinner-border spinner-border-sm align-middle ms-2" />
        </button>
      </div>
    </form>
  </div>
  <div v-if="goods?.length" class="card pb-4">
    <div class="card-body py-2">
      <div class="table-responsive table-hover">
        <table class="table table-row-bordered table-row-gray-100 align-middle text-center gs-0 gy-3">
          <thead>
            <tr class="fw-bolder text-muted">
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
            <template v-for="good in goods" :key="good.id">
              <tr>
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
import { computed, defineComponent, ref } from 'vue'
import { useField, useForm } from 'vee-validate'
import { mixed } from 'yup'
import { serialize } from 'object-to-formdata'

interface Page {
  data: {
    goods?: Array<{
      id: number
      row: number
      sku: string
      name: string
      qty: number
      stock: number
      price: number
      rrp: number
      discount: number
      salePrice: number
      total: number
      weight: number
      volume: number
    }>
    counts?: Record<string, string>
  }
}

type FormFields = { excel: string[] }

export default defineComponent({
  setup() {
    const { route } = useRoute()

    const page = usePage<Page>()
    const data = computed(() => page.props.value.data)

    const fileInput = ref(null as unknown as HTMLInputElement)

    const { handleSubmit, errors, setErrors } = useForm<FormFields>({ validateOnMount: false })
    const { value: excel } = useField('excel', mixed().label('Название'), { initialValue: null })

    function handleFileChange(e: Event): void {
      if (e.target instanceof HTMLInputElement) {
        excel.value = e.target.files ? e.target.files[0] : null
      }
    }

    const isLoading = ref(false)

    const submit = handleSubmit((data: FormFields) => {
      isLoading.value = true
      Inertia.post(route('order.codes.goods'), data, {
        preserveState: false,
        preserveScroll: true,
        onSuccess() {
          fileInput.value.value = ''
          excel.value = null
        },
        onError: (errors) => setErrors(errors),
        onFinish: () => (isLoading.value = false),
      })
    })

    const counts = ref<Record<string, string>>(data.value.counts ?? {})
    const disabled = computed(() => !Object.values(counts.value).filter((c) => c).length)

    const hasOverstock = computed(() => {
      for (const id in counts.value) {
        if (counts.value[id] && data.value.goods?.find((good) => good.id === parseInt(id))?.stock === 0) {
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
      isLoading,
      route,
      submit,
      errors,
      fileInput,
      excel,
      handleFileChange,
      goods: data.value.goods,
      counts,
      disabled,
      hasOverstock,
      addToCart,
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
