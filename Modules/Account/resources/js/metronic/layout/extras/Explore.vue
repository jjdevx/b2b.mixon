<template>
  <!--begin::Exolore drawer toggle-->
  <button
    id="kt_explore_toggle"
    class="btn btn-sm btn-white btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6"
    :title="`Explore ${themeName}`"
    data-bs-toggle="tooltip"
    data-bs-placement="right"
    data-bs-trigger="hover"
  >
    <span id="kt_explore_toggle_label">Explore</span>
  </button>
  <!--end::Exolore drawer toggle-->

  <!--begin::Exolore drawer-->
  <div
    id="kt_explore"
    class="bg-white"
    data-kt-drawer="true"
    data-kt-drawer-name="explore"
    data-kt-drawer-activate="true"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'300px', 'lg': '375px'}"
    data-kt-drawer-direction="end"
    data-kt-drawer-toggle="#kt_explore_toggle"
    data-kt-drawer-close="#kt_explore_close"
  >
    <!--begin::Card-->
    <div class="card shadow-none w-100">
      <!--begin::Header-->
      <div
        id="kt_explore_header"
        class="card-header"
      >
        <h3 class="card-title fw-bolder text-gray-700">
          Explore Metronic
        </h3>

        <div class="card-toolbar">
          <button
            id="kt_explore_close"
            type="button"
            class="btn btn-sm btn-icon btn-active-light-primary me-n5"
          >
            <span class="svg-icon svg-icon-2">
              <inline-svg src="/dist/media/icons/duotone/Navigation/Close.svg" />
            </span>
          </button>
        </div>
      </div>
      <!--end::Header-->

      <!--begin::Body-->
      <div
        id="kt_explore_body"
        class="card-body"
      >
        <!--begin::Content-->
        <div
          id="kt_explore_scroll"
          class="scroll-y me-n5 pe-5"
          data-kt-scroll="true"
          data-kt-scroll-height="auto"
          data-kt-scroll-wrappers="#kt_explore_body"
          data-kt-scroll-dependencies="#kt_explore_header, #kt_explore_footer"
          data-kt-scroll-offset="5px"
        >
          <!--begin::Demos-->
          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo1
              </h3>
              <div
                class="overlay overflow-hidden border border-4 border-primary p-2 rounded"
              >
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo1.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo1"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo2
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo2.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo2"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo3
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo3.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo3"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo4
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo4.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo4"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo5
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo5.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo5"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo6
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo6.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo6"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo7
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo7.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo7"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo8
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo8.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo8"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo9
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo9.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo9"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo10
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo10.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo10"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo11
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo11.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo11"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo12
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo12.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo12"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo13
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo13.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo13"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo14
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo14.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo14"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>

          <div class="mb-0">
            <div class="mb-7">
              <h3 class="fw-bold text-center mb-3">
                Demo15
              </h3>
              <div class="overlay overflow-hidden border border-4 p-2 rounded">
                <div class="overlay-wrapper rounded">
                  <img
                    src="/dist/media/demos/demo15.png"
                    alt="demo"
                    class="w-100 rounded"
                  >
                </div>
                <div class="overlay-layer bg-dark bg-opacity-10">
                  <a
                    href="https://preview.keenthemes.com/metronic8/demo15"
                    class="btn btn-primary shadow"
                  >Preview</a>
                </div>
              </div>
            </div>
          </div>
          <!--end::Demos-->
        </div>
        <!--end::Content-->
      </div>
      <!--end::Body-->

      <!--begin::Footer-->
      <div
        id="kt_explore_footer"
        class="card-footer py-5 text-center"
      >
        <a
          href=""
          class="btn btn-primary"
        > Purchase {{ themeName }} </a>
      </div>
      <!--end::Footer-->
    </div>
    <!--end::Card-->
  </div>
  <!--end::Exolore drawer-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { themeName } from "@/metronic/core/helpers/documentation";

export default defineComponent({
  name: "KtExplore",
  setup() {
    return {
      themeName
    };
  }
});
</script>
