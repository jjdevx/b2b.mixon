<template>
  <!--begin::Header-->
  <div
    id="kt_header"
    style=""
    class="header align-items-stretch"
  >
    <!--begin::Container-->
    <div
      :class="{
        'container-fluid': headerWidthFluid,
        container: !headerWidthFluid
      }"
      class="d-flex align-items-stretch justify-content-between"
    >
      <!--begin::Aside mobile toggle-->
      <div
        class="d-flex align-items-center d-lg-none ms-n3 me-1"
        title="Show aside menu"
      >
        <div
          id="kt_aside_mobile_toggle"
          class="btn btn-icon btn-active-light-primary"
        >
          <span class="svg-icon svg-icon-2x mt-1">
            <inline-svg src="/dist/media/icons/duotone/Text/Menu.svg" />
          </span>
        </div>
      </div>
      <!--end::Aside mobile toggle-->

      <!--begin::Mobile logo-->
      <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
        <a
          href="#"
          class="d-lg-none"
        >
          <img
            alt="Logo"
            src="/dist/media/logos/logo-3.svg"
            class="h-30px"
          >
        </a>
      </div>
      <!--end::Mobile logo-->

      <!--begin::Wrapper-->
      <div
        class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
      >
        <!--begin::Navbar-->
        <div
          v-if="!isDocPage"
          id="kt_header_menu_nav"
          class="d-flex align-items-stretch"
        >
          <KTMenu />
        </div>
        <!--end::Navbar-->

        <template v-if="isDocPage">
          <div class="page-title d-flex align-items-center mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark my-1 fs-4">
              Documentation
              <router-link
                to="/documentation/changelog"
                class="badge badge-light-danger bg-hover-danger text-hover-white fw-bold fs-9 px-2 ms-2"
              >
                v{{ version }}
              </router-link>
            </h1>

            <span class="h-20px border-gray-200 border-start mx-4" />
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-6 my-1">
              <li class="breadcrumb-item text-muted">
                {{ title }}
              </li>
            </ul>
          </div>
        </template>

        <!--begin::Topbar-->
        <div class="d-flex align-items-stretch flex-shrink-0">
          <KTTopbar />
        </div>
        <!--end::Topbar-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Header-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import KTTopbar from "@/metronic/layout/header/Topbar.vue";
import KTMenu from "@/metronic/layout/header/Menu.vue";
import { version } from "@/metronic/core/helpers/documentation";
import { isDocPage } from "@/metronic/core/helpers/documentation";

import {
  headerWidthFluid,
  headerLeft,
  asideDisplay
} from "@/metronic/core/helpers/config";

export default defineComponent({
  name: "KTHeader",
  components: {
    KTTopbar,
    KTMenu
  },
  props: {
    title: String
  },
  setup() {
    return {
      isDocPage,
      headerWidthFluid,
      headerLeft,
      asideDisplay,
      version
    };
  }
});
</script>
