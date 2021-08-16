<template>
  <Form
    id="kt_login_password_reset_form"
    class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
    :validation-schema="forgotPassword"
    @submit="tryReset"
  >
    <div class="text-center mb-10">
      <h1 class="text-dark mb-3">Забыли пароль ?</h1>
      <div class="text-gray-400 fw-bold fs-4">
        Введите почту, которую вы указали при регистрации.
      </div>
    </div>
    <div class="fv-row mb-10">
      <label class="form-label fw-bolder text-gray-900 fs-6">Почта</label>
      <Field
        class="form-control form-control-solid"
        type="email"
        placeholder=""
        name="email"
        autocomplete="off"
      />
      <div class="fv-plugins-message-container">
        <div class="fv-help-block">
          <ErrorMessage name="email" />
        </div>
      </div>
    </div>
    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
      <button
        id="kt_password_reset_submit"
        ref="submitButton"
        type="submit"
        class="btn btn-lg btn-primary fw-bolder me-4"
      >
        <span class="indicator-label">Отправить</span>
        <span v-if="isLoading" class="spinner-border spinner-border-sm align-middle ms-2" />
      </button>

      <InertiaLink href="/login" class="btn btn-lg btn-light-primary fw-bolder">
        Назад
      </InertiaLink>
    </div>
  </Form>
</template>

<script lang="ts">
import { usePage, Inertia, BaseSchema } from 'mixon'
import { defineComponent, ref } from 'vue'
import { ErrorMessage, Field, Form, FormActions } from 'vee-validate'
import { object, string } from 'yup'
import AuthLayout from '@/layouts/Auth.vue'

type FormFields = { email: string }

export default defineComponent({
  components: { Field, Form, ErrorMessage },
  layout: AuthLayout,
  setup() {
    const isLoading = ref(false)

    const forgotPassword = object().shape<Record<keyof FormFields, BaseSchema>>({
      email: string().email().required().label('Email'),
    })

    function tryReset(data: FormFields, e: FormActions<FormFields>): void {
      const { props } = usePage<{ data: { status: number } }>()

      isLoading.value = true

      Inertia.post('', data, {
        onSuccess() {
          if (props.value.data.status === 200) {
            e.resetForm()
          }
        },
        onError(errors) {
          e.setErrors(errors)
        },
        onFinish: () => (isLoading.value = false),
      })
    }

    return { isLoading, forgotPassword, tryReset }
  },
})
</script>
