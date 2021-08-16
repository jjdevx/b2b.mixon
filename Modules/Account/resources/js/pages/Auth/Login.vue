<template>
  <Form
    id="kt_login_signin_form"
    ref="form"
    class="form w-100"
    :validation-schema="login"
    @submit="tryLogin"
  >
    <div class="text-center mb-10">
      <h1 class="text-dark mb-3">Вход в личный кабинет</h1>
      <div class="text-gray-400 fw-bold fs-4">
        Нет аккаунта?

        <InertiaLink href="/register" class="link-primary fw-bolder">
          Зарегистрироваться
        </InertiaLink>
      </div>
    </div>
    <div class="fv-row mb-10">
      <label class="form-label fs-6 fw-bolder text-dark">Почта</label>
      <Field
        class="form-control form-control-lg form-control-solid"
        type="text"
        name="email"
        autocomplete="off"
      />
      <div class="fv-plugins-message-container">
        <div class="fv-help-block">
          <ErrorMessage name="email" />
        </div>
      </div>
    </div>
    <div class="fv-row mb-10">
      <div class="d-flex flex-stack mb-2">
        <label class="form-label fw-bolder text-dark fs-6 mb-0">Пароль</label>
        <InertiaLink href="/password-reset" class="link-primary fs-6 fw-bolder">
          Забыли пароль?
        </InertiaLink>
      </div>
      <Field
        class="form-control form-control-lg form-control-solid"
        type="password"
        name="password"
        autocomplete="off"
      />
      <div class="fv-plugins-message-container">
        <div class="fv-help-block">
          <ErrorMessage name="password" />
        </div>
      </div>
    </div>
    <div class="text-center">
      <button id="kt_sign_in_submit" type="submit" class="btn btn-lg btn-primary w-100 mb-5">
        <span class="indicator-label"> Войти </span>

        <span v-if="isLoading" class="spinner-border spinner-border-sm align-middle ms-2" />
      </button>
    </div>
  </Form>
</template>

<script lang="ts">
import { Inertia, BaseSchema } from 'mixon'
import { defineComponent, ref } from 'vue'
import { ErrorMessage, Field, Form, FormActions } from 'vee-validate'
import AuthLayout from '@/layouts/Auth.vue'
import { object, string } from 'yup'

type FormFields = { email: string; password: string }

export default defineComponent({
  components: { Field, Form, ErrorMessage },
  layout: AuthLayout,
  setup() {
    const isLoading = ref(false)

    const login = object().shape<Record<keyof FormFields, BaseSchema>>({
      email: string().email().required().label('Почта'),
      password: string().min(4).required().label('Пароль'),
    })

    function tryLogin(data: FormFields, actions: FormActions<FormFields>): void {
      isLoading.value = true

      Inertia.post('', data, {
        onError: (errors) => actions.setErrors(errors),
        onFinish: () => (isLoading.value = false),
      })
    }

    return { isLoading, login, tryLogin }
  },
})
</script>
