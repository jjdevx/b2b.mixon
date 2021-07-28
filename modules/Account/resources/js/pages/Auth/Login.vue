<template>
  <Form
    id="kt_login_signin_form"
    ref="form"
    class="form w-100"
    :validation-schema="login"
    @submit="tryLogin"
  >
    <div class="text-center mb-10">
      <h1 class="text-dark mb-3">
        Вход в личный кабинет
      </h1>
      <div class="text-gray-400 fw-bold fs-4">
        Нет аккаунта?

        <InertiaLink
          href="/register"
          class="link-primary fw-bolder"
        >
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
        <label
          class="form-label fw-bolder text-dark fs-6 mb-0"
        >Пароль</label>
        <InertiaLink
          href="/password-reset"
          class="link-primary fs-6 fw-bolder"
        >
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
      <button
        id="kt_sign_in_submit"
        type="submit"
        class="btn btn-lg btn-primary w-100 mb-5"
      >
        <span class="indicator-label">
          Войти
        </span>

        <span
          v-if="isLoading"
          class="spinner-border spinner-border-sm align-middle ms-2"
        />
      </button>
    </div>
  </Form>
</template>

<script lang="ts">
import {defineComponent, ref} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {ErrorMessage, Field, Form, FormActions} from 'vee-validate'
import * as Yup from 'yup'
import AuthLayout from '@/layouts/Auth.vue'

export default defineComponent({
  components: {
    Field,
    Form,
    ErrorMessage
  },
  layout: AuthLayout,
  setup() {
    const isLoading = ref(false)

    const login = Yup.object().shape({
      email: Yup.string()
        .email()
        .required()
        .label('Почта'),
      password: Yup.string()
        .min(4)
        .required()
        .label('Пароль')
    })

    type FormFields = { email: string, password: string }

    function tryLogin(data: FormFields, e: FormActions<FormFields>): void {
      isLoading.value = true

      Inertia.post('', data, {
        onError(errors) {
          e.setErrors(errors)
        },
        onFinish: () => isLoading.value = false
      })
    }

    return {isLoading, login, tryLogin}
  }
})
</script>
