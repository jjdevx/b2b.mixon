<template>
  <!--begin::Section-->
  <div class="py-10">
    <!--begin::Heading-->
    <h1
      id="basic"
      class="anchor fw-bolder mb-5"
    >
      <a href="#basic" />
      Basic Example
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Click the below toggle button to see a slightly customized modal with
      custom close icon button.
    </div>
    <!--end::Block-->

    <!--begin::Block-->
    <div class="py-5">
      <div class="rounded border p-10">
        <button
          type="button"
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#kt_modal_1"
        >
          Launch demo modal
        </button>

        <div
          id="kt_modal_1"
          class="modal fade"
          tabindex="-1"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  Modal title
                </h5>

                <!--begin::Close-->
                <div
                  class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <span class="svg-icon svg-icon-2x">
                    <inline-svg
                      src="/dist/media/icons/duotone/Navigation/Close.svg"
                    />
                  </span>
                </div>
                <!--end::Close-->
              </div>

              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-light"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-primary"
                >
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end::Block-->

    <!--begin::Code-->
    <div class="py-5">
      <CodeHighlighter
        :field-height="400"
        lang="html"
      >
        {{`<button
          type="button"
          class="btn btn-primary"
          data-bs-toggle="modal"
          data-bs-target="#kt_modal_1"
        >
          Launch demo modal
        </button>

        <div
          id="kt_modal_1"
          class="modal fade"
          tabindex="-1"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  Modal title
                </h5>

                <!--begin::Close-->
                <div
                  class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                >
                  <span class="svg-icon svg-icon-2x" />
                </div>
                <!--end::Close-->
              </div>

              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-light"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <button
                  type="button"
                  class="btn btn-primary"
                >
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
        `}}
      </CodeHighlighter>
    </div>
    <!--end::Code-->
  </div>
  <!--end::Section-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";

export default defineComponent({
  name: "BasicExample",
  components: {
    CodeHighlighter
  }
});
</script>
