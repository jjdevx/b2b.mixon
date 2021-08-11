<template>
  <!--begin::Section-->
  <div class="py-10">
    <!--begin::Heading-->
    <h1
      id="avatar-bg"
      class="anchor fw-bolder mb-5"
    >
      <a href="#avatar-bg" />
      Avatar Background
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Refer to below example to place avatar as background image:
    </div>
    <!--end::Block-->

    <!--begin::Block-->
    <div class="py-5">
      <div class="rounded border p-10 pb-0 d-flex flex-wrap">
        <div class="symbol symbol-50px me-10 mb-10">
          <div
            class="symbol-label"
            style="background-image:url('/dist/media/avatars/150-7.jpg')"
          />
        </div>

        <div class="symbol symbol-50px me-10 mb-10">
          <div
            class="symbol-label"
            style="background-image: url('/dist/media/avatars/150-8.jpg')"
          />
        </div>

        <div class="symbol symbol-50px me-10 mb-10">
          <div
            class="symbol-label"
            style="background-image: url('/dist/media/avatars/150-9.jpg')"
          />
        </div>

        <div class="symbol symbol-50px me-10 mb-10">
          <div
            class="symbol-label"
            style="background-image: url('/dist/media/avatars/150-10.jpg')"
          />
        </div>

        <div class="symbol symbol-50px me-10 mb-10">
          <div
            class="symbol-label"
            style="background-image: url('/dist/media/avatars/150-11.jpg')"
          />
        </div>

        <div class="symbol symbol-50px me-10 mb-10">
          <div
            class="symbol-label"
            style="background-image: url('/dist/media/avatars/150-12.jpg')"
          />
        </div>
      </div>
    </div>
    <!--end::Block-->

    <!--begin::Code-->
    <div class="py-5">
      <CodeHighlighter
        lang="html"
      >
        {{`
        <div class="symbol symbol-50px">
          <div
            class="symbol-label"
            style="background-image:url('assets/dist/media/avatars/150-7.jpg')"
          />
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
  name: "AvatarBackground",
  components: {
    CodeHighlighter
  }
});
</script>
