<template>
  <!--begin::Section-->
  <div class="py-10">
    <!--begin::Heading-->
    <h1
      id="image-usage"
      class="anchor fw-bolder mb-3"
    >
      <a href="#image-usage" />
      Image Usage
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Use svg icons as image with <code>&lt;img&gt;</code> tag as shown below:
    </div>
    <!--end::Block-->

    <!--begin::Block-->
    <div class="py-5">
      <div class="rounded border d-flex flex-wrap p-10">
        <img
          src="/dist/media/icons/duotone/Design/Adjust.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Code/Git3.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Communication/Chat2.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Design/Brush.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Design/Sketch.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Files/File-plus.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/General/Settings-2.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Tools/Tools.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Shopping/Chart-bar3.svg"
          class="h-40px me-10"
        >
      </div>
    </div>
    <!--end::Block-->

    <!--begin::Code-->
    <div class="py-5">
      <CodeHighlighter
        lang="html"
      >
        {{`<img
          src="/dist/media/icons/duotone/Design/Adjust.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Code/Git3.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Communication/Chat2.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Design/Brush.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Design/Sketch.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Files/File-plus.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/General/Settings-2.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Tools/Tools.svg"
          class="h-40px me-10"
        >
        <img
          src="/dist/media/icons/duotone/Shopping/Chart-bar3.svg"
          class="h-40px me-10"
        >`}}
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
  name: "ImageUsage",
  components: {
    CodeHighlighter
  }
});
</script>
