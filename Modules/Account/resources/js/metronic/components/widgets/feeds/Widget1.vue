<template>
  <!--begin::Feeds Widget 1-->
  <div
    class="card"
    :class="widgetClasses"
  >
    <!--begin::Body-->
    <div class="card-body pb-0">
      <!--begin::Header-->
      <div class="d-flex align-items-center">
        <!--begin::User-->
        <div class="d-flex align-items-center flex-grow-1">
          <!--begin::Avatar-->
          <div class="symbol symbol-45px me-5">
            <img
              src="/dist/media/avatars/150-1.jpg"
              alt=""
            >
          </div>
          <!--end::Avatar-->

          <!--begin::Info-->
          <div class="d-flex flex-column">
            <a
              href="#"
              class="text-gray-800 text-hover-primary fs-6 fw-bolder"
            >Grace Green</a>

            <span class="text-gray-400 fw-bold">PHP, SQLite, Artisan CLI</span>
          </div>
          <!--end::Info-->
        </div>
        <!--end::User-->

        <!--begin::Menu-->
        <div class="my-0">
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
          <Dropdown2 />
        </div>
        <!--end::Menu-->
      </div>
      <!--end::Header-->

      <!--begin::Form-->
      <form
        id="kt_forms_widget_1_form"
        class="ql-quil ql-quil-plain pb-3"
      >
        <!--begin::Editor-->
        <div
          id="kt_forms_widget_1_editor"
          class="py-6"
        />
        <!--end::Editor-->

        <div class="separator" />

        <!--begin::Toolbar-->
        <div
          id="kt_forms_widget_1_editor_toolbar"
          class="ql-toolbar d-flex flex-stack py-2"
        >
          <div class="me-2">
            <span class="ql-formats ql-size ms-0">
              <select class="ql-size w-75px" />
            </span>

            <span class="ql-formats">
              <button class="ql-bold" />
              <button class="ql-italic" />
              <button class="ql-underline" />
              <button class="ql-strike" />
              <button class="ql-image" />
              <button class="ql-link" />
              <button class="ql-clean" />
            </span>
          </div>

          <div class="me-n3">
            <span class="btn btn-icon btn-sm btn-active-color-primary">
              <i class="flaticon2-clip-symbol icon-ms" />
            </span>

            <span class="btn btn-icon btn-sm btn-active-color-primary">
              <i class="flaticon2-pin icon-ms" />
            </span>
          </div>
        </div>
        <!--end::Toolbar-->
      </form>
      <!--end::Form-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Feeds Widget 1-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import Quill from "quill/dist/quill.js";
import Dropdown2 from "@/metronic/components/dropdown/Dropdown2.vue";

export default defineComponent({
  name: "Widget1",
  components: {
    Dropdown2
  },
  props: {
    widgetClasses: String
  },
  setup() {
    onMounted(() => {
      const editorId = "kt_forms_widget_1_editor";

      // init editor
      const options: object = {
        modules: {
          toolbar: {
            container: "#kt_forms_widget_1_editor_toolbar"
          }
        },
        theme: "snow"
      };

      // Init editor
      new Quill(`#${  editorId}`, options);
    });
  }
});
</script>
