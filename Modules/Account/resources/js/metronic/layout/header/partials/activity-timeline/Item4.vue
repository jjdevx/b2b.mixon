<template>
  <!--begin::Timeline item-->
  <div class="timeline-item">
    <!--begin::Timeline line-->
    <div class="timeline-line w-40px" />
    <!--end::Timeline line-->

    <!--begin::Timeline icon-->
    <div class="timeline-icon symbol symbol-circle symbol-40px">
      <div class="symbol-label bg-light">
        <span class="svg-icon svg-icon-2 svg-icon-gray-500">
          <inline-svg src="/dist/media/icons/duotone/Home/Library.svg" />
        </span>
      </div>
    </div>
    <!--end::Timeline icon-->

    <!--begin::Timeline content-->
    <div class="timeline-content mb-10 mt-n1">
      <!--begin::Timeline heading-->
      <div class="pe-3 mb-5">
        <!--begin::Title-->
        <div class="fs-5 fw-bold mb-2">
          Task <a
            href="#"
            class="text-primary fw-bolder me-1"
          >#45890</a> merged
          with <a
            href="#"
            class="text-primary fw-bolder me-1"
          >#45890</a> in
          “Ads Pro Admin Dashboard project:
        </div>
        <!--end::Title-->

        <!--begin::Description-->
        <div class="d-flex align-items-center mt-1 fs-6">
          <!--begin::Info-->
          <div class="text-muted me-2 fs-7">
            Initiated at 4:23 PM by
          </div>
          <!--end::Info-->

          <!--begin::User-->
          <div
            class="symbol symbol-circle symbol-25px"
            data-bs-toggle="tooltip"
            data-bs-boundary="window"
            data-bs-placement="top"
            title="Nina Nilson"
          >
            <img
              src="/dist/media/avatars/150-11.jpg"
              alt="img"
            >
          </div>
          <!--end::User-->
        </div>
        <!--end::Description-->
      </div>
      <!--end::Timeline heading-->
    </div>
    <!--end::Timeline content-->
  </div>
  <!--end::Timeline item-->
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "",
  components: {}
});
</script>
