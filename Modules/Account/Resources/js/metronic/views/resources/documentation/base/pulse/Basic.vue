<template>
  <!--begin::Section-->
  <div class="py-10">
    <!--begin::Heading-->
    <h1
      id="basic"
      class="anchor fw-bolder mb-5"
    >
      <a href="#basic" />
      Basic
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Use <code>.pulse</code> with for any element to provide a user's
      attentation.
    </div>
    <!--end::Block-->

    <!--begin::Block-->
    <div class="py-5">
      <div class="rounded border p-10 pb-0 d-flex align-items-center flex-wrap">
        <a
          href="#"
          class="btn btn-icon btn-light pulse me-10 mb-10"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Layout/Layout-4-blocks.svg" />
          </span>
          <span class="pulse-ring" />
        </a>

        <a
          href="#"
          class="btn btn-icon btn-light pulse me-10 mb-10"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Code/Done-circle.svg" />
          </span>
          <span class="pulse-ring" />
        </a>

        <a
          href="#"
          class="btn btn-icon btn-light pulse me-10 mb-10"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg
              src="/dist/media/icons/duotone/Communication/Mail-error.svg"
            />
          </span>
          <span class="pulse-ring" />
        </a>

        <a
          href="#"
          class="btn btn-icon btn-light pulse me-10 mb-10"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Design/Color-profile.svg" />
          </span>
          <span class="pulse-ring" />
        </a>

        <a
          href="#"
          class="btn btn-icon btn-light pulse me-10 mb-10"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Design/PenAndRuller.svg" />
          </span>
          <span class="pulse-ring" />
        </a>

        <a
          href="#"
          class="btn btn-icon btn-light pulse me-10 mb-10"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg src="/dist/media/icons/duotone/Files/File.svg" />
          </span>
          <span class="pulse-ring" />
        </a>
      </div>
    </div>
    <!--end::Block-->

    <!--begin::Code-->
    <div class="py-5">
      <CodeHighlighter
        lang="html"
      >
        {{`<a
          href="#"
          class="btn btn-icon btn-light pulse"
        >
          <span class="svg-icon svg-icon-2"><svg>...</svg></span>
          <span class="pulse-ring" /> </a>`}}
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
  name: "Basic",
  components: {
    CodeHighlighter
  }
});
</script>
