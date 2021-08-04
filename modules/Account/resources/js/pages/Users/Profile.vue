<template>
  <div class="card w-lg-500px mx-auto mb-5 mb-xl-10">
    <Form
      id="kt_account_profile_details_form"
      class="form"
      novalidate="novalidate"
      :initial-values="user"
      :validation-schema="userValidationSchema"
      @submit="submit"
    >
      <div class="card-body border-top p-9">
        <div class="d-flex flex-column align-items-center mb-4">
          <div
            class="image-input image-input-outline mb-2"
            data-kt-image-input="true"
            :class="{'image-input-empty': !user?.avatar}"
            style="background-image: url(/dist/img/no-avatar.png);"
          >
            <div
              class="image-input-wrapper w-125px h-125px"
              :style="`background-image: url(${user?user.avatar:''})`"
            />
            <span
              class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
              data-kt-image-input-action="remove"
              data-bs-toggle="tooltip"
              title="Remove avatar"
              @click="removeAvatar()"
            >
              <i class="bi bi-x fs-2" />
            </span>
          </div>
          <Field
            class="form-control form-control-lg form-control-solid"
            type="file"
            accept=".png, .jpg, .jpeg"
            name="avatar"
            autocomplete="off"
          />
          <ErrorMessage name="avatar" />
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
        <div class="fv-row mb-7">
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

        <div
          v-if="!isProfile"
          class="fv-row mb-7"
        >
          <label class="form-label fw-bolder text-dark fs-6">Роль</label>
          <Field
            v-slot="{ value }"
            class="form-control form-control-lg form-control-solid"
            as="select"
            multiple
            name="roles"
            autocomplete="off"
          >
            <option
              v-for="{value:id,text} in roles"
              :key="id"
              :value="id"
              :selected="value && value.includes(id)"
            >
              {{ text }}
            </option>
          </Field>
          <div class="fv-plugins-message-container">
            <div class="fv-help-block">
              <ErrorMessage name="roles" />
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <InertiaLink
          :href="route('users.index')"
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
    </Form>
  </div>
</template>

<script lang="ts">
import {usePage, useRoute, Inertia, BaseSchema} from 'mixon'
import {computed, defineComponent, ref} from 'vue'
import {ErrorMessage, Field, Form, FormActions} from 'vee-validate'
import {object, string, array, number, mixed} from 'yup'
import {User} from '@/types/users'

interface Page {
  data: {
    user?: User
    roles: Array<{ value: number, text: string }>
  }
}

type FormFields = Omit<User, 'id'> & { avatar: string }

export default defineComponent({
  components: {ErrorMessage, Field, Form},
  setup() {
    const {props} = usePage<Page>()

    const user = computed(() => props.value.data.user)
    const roles = props.value.data.roles

    const {route, routeIncludes} = useRoute()

    const isProfile = routeIncludes('profile.edit')

    const isLoading = ref(false)

    const schema: Record<keyof FormFields, BaseSchema> = {
      avatar: mixed()
        .label('Фото'),
      name: string()
        .min(2)
        .required()
        .label('Имя'),
      surname: string()
        .min(3)
        .required()
        .label('Фамилия'),
      email: string()
        .required()
        .email()
        .label('Почта'),
      password: string()
        .nullable()
        .label('Пароль'),
      company: string()
        .min(4)
        .nullable()
        .label('Предприятие'),
      okpo: string()
        .min(6)
        .nullable()
        .label('ОКПО'),
      country: string()
        .min(3)
        .nullable()
        .label('Страна'),
      city: string()
        .min(2)
        .nullable()
        .label('Город'),
      address: string()
        .min(10)
        .nullable()
        .label('Адрес'),
      fax: string()
        .min(10)
        .nullable()
        .label('Факс'),
      phone: string()
        .min(10)
        .nullable()
        .label('Телефон'),
      roles: array()
        .of(number())
    }
    const userValidationSchema = object().shape(schema)

    function submit(data: FormFields, actions: FormActions<FormFields>): void {
      isLoading.value = true

      let url = user.value ? route('users.update', user.value.id) : route('users.store')
      if (isProfile) {
        url = route('profile.update')
      }

      data.avatar = Array.isArray(data.avatar) ? data.avatar[0] : ''

      Inertia.post(url, {...data, _method: user.value ? 'PATCH' : null}, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => actions.setFieldValue('password', ''),
        onError: errors => actions.setErrors(errors),
        onFinish: () => isLoading.value = false
      })
    }

    const removeAvatar = () => Inertia.delete(
      isProfile ? route('profile.avatar.destroy') : route('users.avatar.destroy', user.value?.id)
    )

    return {userValidationSchema, user, submit, removeAvatar, roles, isProfile, isLoading, route}
  }
})
</script>
