<template>
  <div class="card w-lg-500px mx-auto mb-5 mb-xl-10">
    <form id="kt_account_profile_details_form" class="form" novalidate @submit.prevent="submit">
      <div class="card-body border-top p-9">
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Название*</label>
          <input v-model="name" class="form-control form-control-lg form-control-solid" />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.name }}
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <InertiaLink
          :href="route('groups.index')"
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
import { string } from 'yup'
import { Group } from '@/types/goods'

interface Page {
  data: {
    group?: Group
  }
}

type FormFields = Omit<Group, 'id' | 'createdAt' | 'updatedAt'>

export default defineComponent({
  setup() {
    const { props } = usePage<Page>()
    const { route } = useRoute()

    const group = computed(() => props.value.data?.group)

    const { handleSubmit, errors, setErrors } = useForm<FormFields>({
      validateOnMount: false,
      initialValues: group.value ?? {
        name: '',
      },
    })
    const { value: name } = useField('name', string().min(4).required().label('Название'))

    const isLoading = ref(false)

    const submit = handleSubmit((data: FormFields) => {
      isLoading.value = true
      Inertia.post(
        group.value ? route('groups.update', group.value.id) : route('groups.store'),
        { ...data, _method: group.value ? 'PATCH' : null },
        {
          preserveState: true,
          preserveScroll: true,
          onError: (errors) => setErrors(errors),
          onFinish: () => (isLoading.value = false),
        }
      )
    })

    return {
      group,
      isLoading,
      route,
      submit,
      errors,
      name,
    }
  },
})
</script>
