<template>
  <Form
    class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
    novalidate="novalidate"
    :validation-schema="registration"
    @submit="tryRegister"
  >
    <div class="mb-10 text-center">
      <h1 class="text-dark mb-3">Регистрация</h1>
      <div class="text-gray-400 fw-bold fs-4">
        Уже есть аккаунт?

        <InertiaLink href="/login" class="link-primary fw-bolder"> Войти </InertiaLink>
      </div>
    </div>

    <div class="row fv-row mb-7">
      <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Имя*</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="name"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="name" />
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Фамилия*</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="surname"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="surname" />
          </div>
        </div>
      </div>
    </div>
    <div class="fv-row mb-7">
      <label class="form-label fw-bolder text-dark fs-6">Почта*</label>
      <Field
        class="form-control form-control-lg form-control-solid"
        type="email"
        name="email"
        autocomplete="off"
      />
      <div class="fv-plugins-message-container">
        <div class="fv-help-block">
          <ErrorMessage name="email" />
        </div>
      </div>
    </div>
    <div class="row fv-row mb-7">
      <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Пароль*</label>
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
      <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Подтверждение пароля*</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="password"
          name="passwordConfirmation"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="passwordConfirmation" />
          </div>
        </div>
      </div>
    </div>

    <div class="row fv-row mb-7">
      <div class="col-xl-7">
        <label class="form-label fw-bolder text-dark fs-6">Предприятие</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="company"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="company" />
          </div>
        </div>
      </div>
      <div class="col-xl-5">
        <label class="form-label fw-bolder text-dark fs-6">Код ОКПО</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="number"
          name="okpo"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="okpo" />
          </div>
        </div>
      </div>
    </div>

    <div class="row fv-row mb-7">
      <div class="col-xl-5">
        <label class="form-label fw-bolder text-dark fs-6">Страна</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          value="Украина"
          name="country"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="country" />
          </div>
        </div>
      </div>
      <div class="col-xl-7">
        <label class="form-label fw-bolder text-dark fs-6">Город</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="city"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="city" />
          </div>
        </div>
      </div>
    </div>
    <div class="fv-row mb-7">
      <label class="form-label fw-bolder text-dark fs-6">Адрес</label>
      <Field
        class="form-control form-control-lg form-control-solid"
        type="text"
        name="address"
        autocomplete="off"
      />
      <div class="fv-plugins-message-container">
        <div class="fv-help-block">
          <ErrorMessage name="address" />
        </div>
      </div>
    </div>
    <div class="row fv-row mb-7">
      <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Факс</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="fax"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="fax" />
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <label class="form-label fw-bolder text-dark fs-6">Телефон</label>
        <Field
          class="form-control form-control-lg form-control-solid"
          type="text"
          name="phone"
          autocomplete="off"
        />
        <div class="fv-plugins-message-container">
          <div class="fv-help-block">
            <ErrorMessage name="phone" />
          </div>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-lg btn-primary">
        Отправить
        <span v-if="isLoading" class="spinner-border spinner-border-sm align-middle ms-2" />
      </button>
    </div>
  </Form>
</template>

<script lang="ts">
import { BaseSchema, Inertia } from 'mixon'
import { defineComponent, ref } from 'vue'
import { ErrorMessage, Field, Form, FormActions } from 'vee-validate'
import AuthLayout from '@/layouts/Auth.vue'
import { object, ref as reference, string } from 'yup'
import { User } from '@/types/users'

type FormFields = Omit<User, 'avatar' | 'id' | 'shippingPoint' | 'roles' | 'categories'> & {
  passwordConfirmation: string
}

export default defineComponent({
  components: { Field, Form, ErrorMessage },
  layout: AuthLayout,
  setup() {
    const isLoading = ref(false)

    const registration = object().shape<Record<keyof FormFields, BaseSchema>>({
      name: string().min(2).required().label('Имя'),
      surname: string().min(3).required().label('Фамилия'),
      email: string().required().email().label('Почта'),
      password: string().min(4).required().label('Пароль'),
      passwordConfirmation: string()
        .min(4)
        .required()
        .oneOf([reference('password'), null], 'Пароли должны совпадать.')
        .label('Подтверждение пароля'),
      company: string().min(4).nullable().label('Предприятие'),
      okpo: string().min(6).nullable().label('ОКПО'),
      country: string().min(3).nullable().label('Страна'),
      city: string().min(2).nullable().label('Город'),
      address: string().min(10).nullable().label('Адрес'),
      fax: string().min(10).nullable().label('Факс'),
      phone: string().min(10).nullable().label('Телефон'),
    })

    function tryRegister(data: FormFields, actions: FormActions<FormFields>): void {
      isLoading.value = true

      Inertia.post('', data, {
        onError: (errors) => actions.setErrors(errors),
        onFinish: () => (isLoading.value = false),
      })
    }

    return {
      isLoading,
      registration,
      tryRegister,
    }
  },
})
</script>
