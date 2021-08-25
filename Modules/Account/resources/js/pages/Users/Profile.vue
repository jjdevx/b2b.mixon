<template>
  <div class="card w-lg-550px mx-auto mb-5 mb-xl-10">
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
            :class="{ 'image-input-empty': !user?.avatar }"
            style="background-image: url(/dist/img/no-avatar.png)"
          >
            <div
              class="image-input-wrapper w-125px h-125px"
              :style="`background-image: url(${user ? user.avatar : ''})`"
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

        <template v-if="!isProfile">
          <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6">Точка отгрузки</label>
            <select v-model="shippingPoint" class="form-control form-control-lg form-control-solid">
              <option :value="null">Нету</option>
              <option v-for="(name, id) in shippingPoints" :key="id" :value="id">
                {{ name }}
              </option>
            </select>
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                {{ shippingPointErrorMessage }}
              </div>
            </div>
          </div>
          <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6">Тип скидки</label>
            <select v-model="saleType" class="form-control form-control-lg form-control-solid">
              <option :value="null">Нету</option>
              <option v-for="(name, type) in saleTypes" :key="type" :value="type">
                {{ name }}
              </option>
            </select>
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                {{ saleTypeErrorMessage }}
              </div>
            </div>
          </div>
          <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6">Роль</label>
            <Multiselect v-model="roles" :options="rolesForSelect" mode="tags" searchable />
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                {{ rolesErrorMessage }}
              </div>
            </div>
          </div>
          <button
            class="btn btn-primary d-block mx-auto mb-7"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#categories"
            aria-expanded="false"
            aria-controls="categories"
          >
            Права просмотра остатков категорий
          </button>
          <div id="categories" class="list-group collapse">
            <button
              class="btn btn-success d-block mx-auto mb-7"
              @click.prevent="setAllCategories()"
            >
              Выбрать все
            </button>
            <label
              v-for="{ value, label } in categoriesForSelect"
              :key="value"
              class="list-group-item"
            >
              <input
                v-model="categories"
                class="form-check-input me-1"
                type="checkbox"
                :value="value"
              />
              {{ label }}
            </label>
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                {{ categoriesErrorMessage }}
              </div>
            </div>
          </div>
          <button
            class="btn btn-primary d-block mx-auto mb-7"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sales"
            aria-expanded="false"
            aria-controls="sales"
          >
            Скидки по категориям
          </button>
          <div id="sales" class="list-group sales-list collapse">
            <button class="btn btn-danger d-block mx-auto mb-7" @click.prevent="resetAllSales()">
              Удалить все
            </button>
            <label
              v-for="{ value, label } in categoriesForSelect"
              :key="value"
              class="list-group-item sales-list__item"
            >
              {{ label }}
              <input
                v-model="sales[value]"
                class="form-control form-control-sm sales-list__input"
                type="number"
                min="0"
                max="99.99"
                step="0.01"
              />
            </label>
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                {{ salesErrorMessage }}
              </div>
            </div>
          </div>
        </template>
      </div>
      <div class="card-footer d-flex justify-content-end py-6 px-9">
        <InertiaLink
          :href="route('users.index')"
          class="btn btn-white btn-active-light-primary me-2"
        >
          Назад
        </InertiaLink>

        <button type="submit" class="btn btn-primary">
          Сохранить
          <span v-if="isLoading" class="spinner-border spinner-border-sm align-middle ms-2" />
        </button>
      </div>
    </Form>
  </div>
</template>

<script lang="ts">
import { BaseSchema, Inertia, usePage, useRoute } from 'mixon'
import { computed, defineComponent, ref, watch } from 'vue'
import { ErrorMessage, Field, Form, FormActions, useField } from 'vee-validate'
import Multiselect from '@vueform/multiselect'
import { array, mixed, number, object, string } from 'yup'
import { User } from '@/types/users'

interface SelectItem {
  value: number
  label: string
}

interface Page {
  data: {
    user?: User
    shippingPoints: Record<number, string>
    saleTypes: Record<string, string>
    roles: Array<SelectItem>
    categories: Array<SelectItem>
  }
}

type FormFields = Omit<User, 'id' | 'shippingPoint' | 'saleType' | 'roles' | 'categories'> & {
  avatar: string
}

export default defineComponent({
  components: { ErrorMessage, Field, Form, Multiselect },
  setup() {
    const { props } = usePage<Page>()
    const { route, routeIncludes } = useRoute()

    const user = computed(() => props.value.data?.user)
    const shippingPoints = props.value.data.shippingPoints
    const saleTypes = props.value.data.saleTypes
    const rolesForSelect = props.value.data.roles
    const categoriesForSelect = props.value.data.categories

    const isProfile = routeIncludes('profile.edit')

    const isLoading = ref(false)

    const schema: Record<keyof FormFields, BaseSchema> = {
      avatar: mixed().label('Фото'),
      name: string().min(2).required().label('Имя'),
      surname: string().min(3).required().label('Фамилия'),
      email: string().required().email().label('Почта'),
      password: string().nullable().label('Пароль'),
      company: string().min(4).nullable().label('Предприятие'),
      okpo: string().min(6).nullable().label('ОКПО'),
      country: string().min(3).nullable().label('Страна'),
      city: string().min(2).nullable().label('Город'),
      address: string().min(10).nullable().label('Адрес'),
      fax: string().min(10).nullable().label('Факс'),
      phone: string().min(10).nullable().label('Телефон'),
    }
    const userValidationSchema = object().shape(schema)
    const { value: shippingPoint, errorMessage: shippingPointErrorMessage } = useField(
      'shippingPoint',
      number().nullable().label('Точка отгрузки'),
      { initialValue: user.value?.shippingPoint }
    )
    const { value: saleType, errorMessage: saleTypeErrorMessage } = useField(
      'saleType',
      mixed().nullable().label('Тип скидки'),
      { initialValue: user.value?.saleType }
    )
    const { value: roles, errorMessage: rolesErrorMessage } = useField(
      'roles',
      array().of(number()).required().label('Роли'),
      { initialValue: user.value?.roles }
    )
    const { value: categories, errorMessage: categoriesErrorMessage } = useField(
      'categories',
      array().of(number()).required().label('Категории'),
      { initialValue: user.value?.categories ?? [] }
    )
    const { value: sales, errorMessage: salesErrorMessage } = useField(
      'sales',
      mixed().required().label('Скидки по категориям'),
      { initialValue: user.value?.sales ?? {} }
    )
    const resetAllSales = () => (sales.value = {})

    watch(user, () => (roles.value = user.value?.roles))

    function setAllCategories() {
      const ids = categoriesForSelect.map(({ value }) => value)
      categories.value =
        categories.value.length !== ids.length ? categoriesForSelect.map(({ value }) => value) : []
    }

    function submit(data: FormFields, actions: FormActions<FormFields>): void {
      isLoading.value = true

      let url = user.value ? route('users.update', user.value.id) : route('users.store')
      if (isProfile) {
        url = route('profile.update')
      }

      data.avatar = Array.isArray(data.avatar) ? data.avatar[0] : ''

      Inertia.post(
        url,
        {
          ...data,
          shippingPoint: shippingPoint.value ?? null,
          saleType: saleType.value ?? null,
          roles: roles.value,
          categories: categories.value,
          sales: sales.value,
          _method: user.value ? 'PATCH' : null,
        },
        {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => actions.setFieldValue('password', ''),
          onError: (errors) => actions.setErrors(errors),
          onFinish: () => (isLoading.value = false),
        }
      )
    }

    const avatarDestroyRoute = 'profile.avatar.destroy'
    const removeAvatar = () =>
      Inertia.delete(
        isProfile ? route(avatarDestroyRoute) : route(avatarDestroyRoute, user.value?.id)
      )

    return {
      userValidationSchema,
      user,
      submit,
      removeAvatar,
      shippingPoints,
      saleTypes,
      rolesForSelect,
      categoriesForSelect,
      isProfile,
      isLoading,
      shippingPoint,
      shippingPointErrorMessage,
      saleType,
      saleTypeErrorMessage,
      roles,
      rolesErrorMessage,
      categories,
      categoriesErrorMessage,
      setAllCategories,
      sales,
      salesErrorMessage,
      resetAllSales,
      route,
    }
  },
})
</script>

<style lang="scss" scoped>
.sales-list {
  &__item {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  &__input {
    max-width: 70px;
  }
}
</style>
