<template>
  <!--begin::Toolbar-->
  <div
    id="kt_toolbar"
    class="toolbar"
  >
    <!--begin::Container-->
    <div
      id="kt_toolbar_container"
      class="container-fluid d-flex flex-stack"
    >
      <!--begin::Page title-->
      <div
        class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1"
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
            <router-link
              to="/dashboard"
              class="text-muted text-hover-primary"
            >
              Home
            </router-link>
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

      <!--begin::Actions-->
      <div class="d-flex align-items-center py-1">
        <!--begin::Wrapper-->
        <div class="me-4">
          <!--begin::Menu-->
          <a
            href="#"
            class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
            data-kt-menu-trigger="click"
            data-kt-menu-placement="bottom-end"
            data-kt-menu-flip="top-end"
          >
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
              <inline-svg src="/dist/media/icons/duotone/Text/Filter.svg" />
            </span>
            Filter
          </a>

          <Dropdown1 />
          <!--end::Menu-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Button-->
        <a
          id="kt_toolbar_primary_button"
          href="#"
          class="btn btn-sm btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#kt_modal_create_app"
        >
          Create
        </a>
        <!--end::Button-->
      </div>
      <!--end::Actions-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Toolbar-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Dropdown1 from "@/metronic/components/dropdown/Dropdown1.vue";

export default defineComponent({
  name: "KToolbar",
  components: {
    Dropdown1
  },
  props: {
    breadcrumbs: Array,
    title: String
  }
});
</script>
