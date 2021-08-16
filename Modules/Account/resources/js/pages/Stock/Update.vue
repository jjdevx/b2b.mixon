<template>
  <div class="card w-lg-500px mx-auto mb-5 mb-xl-10">
    <form id="kt_account_profile_details_form" class="form" novalidate @submit.prevent="submit">
      <div class="card-body border-top p-9">
        <h1 class="mb-8">Загрузка наличия для #{{ department.id }} {{ department.name }}</h1>
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Файл*</label>
          <input
            ref="fileInput"
            class="form-control"
            type="file"
            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
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
</template>

<script lang="ts">
import { Inertia, usePage, useRoute } from 'mixon'
import { computed, defineComponent, ref } from 'vue'
import { useField, useForm } from 'vee-validate'
import { mixed } from 'yup'
import { Department } from '@/types/departments'

interface Page {
  data: {
    department: Department
  }
}

type FormFields = { excel: string[] }

export default defineComponent({
  setup() {
    const { props } = usePage<Page>()
    const department = computed(() => props.value.data.department)
    const { route } = useRoute()

    const fileInput = ref(null as unknown as HTMLInputElement)

    const { handleSubmit, errors, setErrors } = useForm<FormFields>({
      validateOnMount: false,
    })
    const { value: excel } = useField('excel', mixed().label('Название'), {
      initialValue: null,
    })

    function handleFileChange(e: Event): void {
      if (e.target instanceof HTMLInputElement) {
        excel.value = e.target.files ? e.target.files[0] : null
      }
    }

    const isLoading = ref(false)

    const submit = handleSubmit((data: FormFields) => {
      isLoading.value = true
      Inertia.post(route('stock.update.handle'), data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess() {
          fileInput.value.value = ''
          excel.value = null
        },
        onError: (errors) => setErrors(errors),
        onFinish: () => (isLoading.value = false),
      })
    })

    return {
      department,
      isLoading,
      route,
      submit,
      errors,
      fileInput,
      excel,
      handleFileChange,
    }
  },
})
</script>
