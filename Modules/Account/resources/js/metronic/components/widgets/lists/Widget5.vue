<template>
  <!--begin::List Widget 5-->
  <div
    class="card"
    :class="widgetClasses"
  >
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
      <h3 class="card-title align-items-start flex-column">
        <span class="fw-bolder mb-2 text-dark">Activities</span>
        <span class="text-muted fw-bold fs-7">890,344 Sales</span>
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
      <!--begin::Timeline-->
      <div class="timeline-label">
        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            08:42
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-warning fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Text-->
          <div class="fw-mormal timeline-content text-muted ps-3">
            Outlines keep you honest. And keep structure
          </div>
          <!--end::Text-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            10:00
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-success fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Content-->
          <div class="timeline-content d-flex">
            <span class="fw-bolder text-gray-800 ps-3">AEOL meeting</span>
          </div>
          <!--end::Content-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            14:37
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-danger fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Desc-->
          <div class="timeline-content fw-bolder text-gray-800 ps-3">
            Make deposit
            <a
              href="#"
              class="text-primary"
            >USD 700</a>. to ESL
          </div>
          <!--end::Desc-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            16:50
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-primary fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Text-->
          <div class="timeline-content fw-mormal text-muted ps-3">
            Indulging in poorly driving and keep structure keep great
          </div>
          <!--end::Text-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            21:03
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-danger fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Desc-->
          <div class="timeline-content fw-bold text-gray-800 ps-3">
            New order placed <a
              href="#"
              class="text-primary"
            >#XF-2356</a>.
          </div>
          <!--end::Desc-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            16:50
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-primary fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Text-->
          <div class="timeline-content fw-mormal text-muted ps-3">
            Indulging in poorly driving and keep structure keep great
          </div>
          <!--end::Text-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            21:03
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-danger fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Desc-->
          <div class="timeline-content fw-bold text-gray-800 ps-3">
            New order placed <a
              href="#"
              class="text-primary"
            >#XF-2356</a>.
          </div>
          <!--end::Desc-->
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="timeline-item">
          <!--begin::Label-->
          <div class="timeline-label fw-bolder text-gray-800 fs-6">
            10:30
          </div>
          <!--end::Label-->

          <!--begin::Badge-->
          <div class="timeline-badge">
            <i class="fa fa-genderless text-success fs-1" />
          </div>
          <!--end::Badge-->

          <!--begin::Text-->
          <div class="timeline-content fw-mormal text-muted ps-3">
            Finance KPI Mobile app launch preparion meeting
          </div>
          <!--end::Text-->
        </div>
        <!--end::Item-->
      </div>
      <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
  </div>
  <!--end: List Widget 5-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import Dropdown1 from "@/metronic/components/dropdown/Dropdown1.vue";
import { MenuComponent } from "@/metronic/assets/ts/components/MenuComponent";

export default defineComponent({
  name: "KtWidget5",
  components: {
    Dropdown1
  },
  props: {
    widgetClasses: String
  },
  setup() {
    onMounted(() => {
      MenuComponent.reinitialization();
    });
  }
});
</script>
