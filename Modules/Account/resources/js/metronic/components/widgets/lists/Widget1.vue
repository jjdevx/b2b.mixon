<template>
  <!--begin::List Widget 1-->
  <div
    class="card"
    :class="widgetClasses"
  >
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder text-dark">Tasks Overview</span>
        <span class="text-muted mt-1 fw-bold fs-7">Pending 10 tasks</span>
      </h3>

      <div class="card-toolbar">
        <!--begin::Menu-->
        <button
          type="button"
          class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
          data-kt-menu-trigger="click"
          data-kt-menu-placement="bottom-end"
          data-kt-menu-flip="top-end"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg
              src="/dist/media/icons/duotone/Layout/Layout-4-blocks-2.svg"
            />
          </span>
        </button>
        <Dropdown1 />
        <!--end::Menu-->
      </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-5">
      <template
        v-for="(item, index) in items"
        :key="index"
      >
        <!--begin::Item-->
        <div
          :class="{ 'mb-7': items.length - 1 !== index }"
          class="d-flex align-items-center"
        >
          <!--begin::Symbol-->
          <div class="symbol symbol-50px me-5">
            <span
              :class="`bg-light-${item.color}`"
              class="symbol-label"
            >
              <span
                :class="`svg-icon-${item.color}`"
                class="svg-icon svg-icon-2x"
              >
                <inline-svg :src="item.icon" />
              </span>
            </span>
          </div>
          <!--end::Symbol-->

          <!--begin::Text-->
          <div class="d-flex flex-column">
            <a
              href="#"
              class="text-dark text-hover-primary fs-6 fw-bolder"
            >{{
              item.title
            }}</a>

            <span class="text-muted fw-bold">{{ item.description }}</span>
          </div>
          <!--end::Text-->
        </div>
        <!--end::Item-->
      </template>
    </div>
    <!--end::Body-->
  </div>
  <!--end::List Widget 1-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Dropdown1 from "@/metronic/components/dropdown/Dropdown1.vue";

export default defineComponent({
  name: "KtWidget1",
  components: {
    Dropdown1
  },
  props: {
    widgetClasses: String
  },
  setup() {
    const items = [
      {
        icon: "/dist/media/icons/duotone/Home/Library.svg",
        color: "success",
        title: "Project Briefing",
        description: "Project Manager"
      },
      {
        icon: "/dist/media/icons/duotone/Communication/Write.svg",
        color: "warning",
        title: "Concept Design",
        description: "Art Director"
      },
      {
        icon: "/dist/media/icons/duotone/Communication/Group-chat.svg",
        color: "primary",
        title: "Functional Logics",
        description: "Lead Developer"
      },
      {
        icon: "/dist/media/icons/duotone/General/Attachment2.svg",
        color: "danger",
        title: "Development",
        description: "DevOps"
      },
      {
        icon: "/dist/media/icons/duotone/Communication/Shield-user.svg",
        color: "info",
        title: "Testing",
        description: "QA Managers"
      }
    ];

    return {
      items
    };
  }
});
</script>
