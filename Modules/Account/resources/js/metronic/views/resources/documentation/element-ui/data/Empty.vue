<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#empty"></a>
      Empty
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Placeholder hints for empty states.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUICustomImage></EUICustomImage>
  <EUIImageSize></EUIImageSize>
  <EUIBottomContent></EUIBottomContent>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/data/empty/BasicUsage.vue";
import EUICustomImage from "@/metronic/views/resources/documentation/element-ui/data/empty/CustomImage.vue";
import EUIImageSize from "@/metronic/views/resources/documentation/element-ui/data/empty/ImageSize.vue";
import EUIBottomContent from "@/metronic/views/resources/documentation/element-ui/data/empty/BottomContent.vue";

export default defineComponent({
  name: "empty",
  components: {
    EUIBasicUsage,
    EUICustomImage,
    EUIImageSize,
    EUIBottomContent
  },
  setup() {
    setCurrentPageTitle("Empty");
  }
});
</script>
