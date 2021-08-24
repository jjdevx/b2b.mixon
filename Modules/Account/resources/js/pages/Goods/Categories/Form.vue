<template>
  <div class="card w-lg-500px mx-auto mb-5 mb-xl-10">
    <form id="kt_account_profile_details_form" class="form" novalidate @submit.prevent="submit">
      <div class="card-body border-top p-9">
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Точка отгрузки*</label>
          <select v-model="groupId" class="form-control form-control-lg form-control-solid">
            <option v-for="{ value, label } in groupsForSelect" :key="value" :value="value">
              {{ label }}
            </option>
          </select>
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.groupId }}
            </div>
          </div>
        </div>
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Название*</label>
          <input v-model="name" class="form-control form-control-lg form-control-solid" />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.name }}
            </div>
          </div>
        </div>
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Номер в группе*</label>
          <input
            v-model="numberInGroup"
            type="number"
            class="form-control form-control-lg form-control-solid"
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.number }}
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <InertiaLink
          :href="route('categories.index')"
          class="btn btn-white btn-active-light-primary me-2"
        >
          Назад
        </InertiaLink>

        <button type="submit" class="btn btn-primary">
          Сохранить
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
import { number, string } from 'yup'
import { Category } from '@/types/goods'

interface Page {
  data: {
    category?: Category
    groups: Array<{ value: number; label: string }>
  }
}

type FormFields = Omit<
  Category,
  'id' | 'saleSmall' | 'sale' | 'saleBig' | 'createdAt' | 'updatedAt'
>

export default defineComponent({
  setup() {
    const { props } = usePage<Page>()
    const { route } = useRoute()

    const category = computed(() => props.value.data?.category)
    const groupsForSelect = props.value.data.groups

    const { handleSubmit, errors, setErrors } = useForm<FormFields>({
      validateOnMount: false,
      initialValues: category.value ?? {
        groupId: 1,
        name: '',
        number: 0,
      },
    })
    const { value: groupId } = useField('groupId', number().required().label('Группа'))
    const { value: name } = useField('name', string().min(4).required().label('Название'))
    const { value: numberInGroup } = useField('number', number().required().label('Номер'))

    const isLoading = ref(false)

    const submit = handleSubmit((data: FormFields) => {
      isLoading.value = true
      Inertia.post(
        category.value ? route('categories.update', category.value.id) : route('categories.store'),
        { ...data, _method: category.value ? 'PATCH' : null },
        {
          preserveState: true,
          preserveScroll: true,
          onError: (errors) => setErrors(errors),
          onFinish: () => (isLoading.value = false),
        }
      )
    })

    return {
      category,
      groupsForSelect,
      isLoading,
      route,
      submit,
      errors,
      groupId,
      name,
      numberInGroup,
    }
  },
})
</script>
