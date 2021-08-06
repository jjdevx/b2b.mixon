<template>
  <div class="card w-lg-500px mx-auto mb-5 mb-xl-10">
    <form
      id="kt_account_profile_details_form"
      class="form"
      novalidate
      @submit.prevent="submit"
    >
      <div class="card-body border-top p-9">
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Название*</label>
          <input
            v-model="name"
            class="form-control form-control-lg form-control-solid"
          >
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.name }}
            </div>
          </div>
        </div>
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Тип*</label>
          <select
            v-model="type"
            class="form-control form-control-lg form-control-solid"
          >
            <option
              v-for="{value,label} in typesForSelect"
              :key="value"
              :value="value"
            >
              {{ label }}
            </option>
          </select>
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.type }}
            </div>
          </div>
        </div>
        <div class="fv-row mb-7">
          <label class="form-label fw-bolder text-dark fs-6">Работники</label>
          <Multiselect
            v-model="users"
            :options="usersForSelect"
            mode="tags"
            searchable
          />
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              {{ errors.users }}
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <InertiaLink
          :href="route('departments.index')"
          class="btn btn-white btn-active-light-primary me-2"
        >
          Назад
        </InertiaLink>

        <button
          type="submit"
          class="btn btn-primary"
        >
          Сохранить
          <span
            v-if="isLoading"
            class="spinner-border spinner-border-sm align-middle ms-2"
          />
        </button>
      </div>
    </form>
  </div>
</template>

<script lang="ts">
import {usePage, useRoute, Inertia} from 'mixon'
import {computed, defineComponent, ref} from 'vue'
import {useField, useForm} from 'vee-validate'
import {string, array, number} from 'yup'
import Multiselect from '@vueform/multiselect'
import {Department} from '@/types/departments'

interface Page {
  data: {
    department?: Department
    types: Array<{ value: number, label: string }>
    users: Array<{ id: number, name: string }>
  }
}

type FormFields = Omit<Department, 'id' | 'createdAt' | 'updatedAt'>

export default defineComponent({
  components: {Multiselect},
  setup() {
    const {props} = usePage<Page>()
    const {route} = useRoute()

    const department = computed(() => props.value.data.department)
    const typesForSelect = props.value.data.types
    const usersForSelect = props.value.data.users

    const {handleSubmit, errors, setErrors} = useForm<FormFields>({
      validateOnMount: false,
      initialValues: department.value ?? {
        name: '',
        type: 'branch',
        users: []
      },
    })
    const {value: name} = useField('name', string().min(4).required().label('Название'))
    const {value: type} = useField('type', string().required().label('Тип'))
    const {value: users} = useField('users', array().of(number()))

    const isLoading = ref(false)

    const submit = handleSubmit((data: FormFields) => {
      isLoading.value = true
      Inertia.post(
        department.value ? route('departments.update', department.value.id) : route('departments.store'),
        {...data, _method: department.value ? 'PATCH' : null},
        {
          preserveState: true,
          preserveScroll: true,
          onError: errors => setErrors(errors),
          onFinish: () => isLoading.value = false
        }
      )
    })

    return {
      department, typesForSelect, usersForSelect, isLoading, route,
      submit, errors, name, type, users
    }
  }
})
</script>
