<template>
  <!--begin::Page title-->
  <div
    data-kt-swapper="true"
    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0"
  >
    <!--begin::Title-->
    <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">
      {{ title }}
    </h1>
    <!--end::Title-->

    <span
      v-if="breadcrumbs"
      class="h-20px border-gray-200 border-start mx-4"
    />

    <!--begin::Breadcrumb-->
    <ul
      v-if="breadcrumbs"
      class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1"
    >
      <li class="breadcrumb-item pe-3">
        <InertiaLink
          href="/dashboard"
          class="text-muted text-hover-primary"
        >
          Home
        </InertiaLink>
      </li>
      <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px" />
      </li>
      <template
        v-for="(item, index) in breadcrumbs"
        :key="index"
      >
        <li class="breadcrumb-item text-muted">
          {{ item }}
        </li>
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-200 w-5px h-2px" />
        </li>
      </template>
      <li class="breadcrumb-item pe-3 text-dark">
        {{ title }}
      </li>
    </ul>
    <!--end::Breadcrumb-->
  </div>
  <!--end::Page title-->
</template>

<script lang="ts">
import {defineComponent} from 'vue'

export default defineComponent({
  name: 'MobilePageTitle',
  components: {},
  props: {
    breadcrumbs: {type: Array, default: () => []},
    title: {type: String, default: ''}
  }
})
</script>
