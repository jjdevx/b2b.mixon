<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#layout"></a>
      Layout
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Quickly and easily create layouts with the basic 24-column.
    </div>
    <!--end::Block-->
  </div>
  <EUILayoutBasic></EUILayoutBasic>
  <EUIColumnSpacing></EUIColumnSpacing>
  <EUIHybridLayout></EUIHybridLayout>
  <EUIColumnOffset></EUIColumnOffset>
  <EUIAlignment></EUIAlignment>
  <EUIResponsiveLayout></EUIResponsiveLayout>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUILayoutBasic from "@/metronic/views/resources/documentation/element-ui/basic/layout/BasicLayout.vue";
import EUIColumnSpacing from "@/metronic/views/resources/documentation/element-ui/basic/layout/ColumnSpacing.vue";
import EUIHybridLayout from "@/metronic/views/resources/documentation/element-ui/basic/layout/HybridLayout.vue";
import EUIColumnOffset from "@/metronic/views/resources/documentation/element-ui/basic/layout/ColumnOffset.vue";
import EUIAlignment from "@/metronic/views/resources/documentation/element-ui/basic/layout/Alignment.vue";
import EUIResponsiveLayout from "@/metronic/views/resources/documentation/element-ui/basic/layout/ResponsiveLayout.vue";

export default defineComponent({
  name: "layout",
  components: {
    EUILayoutBasic,
    EUIColumnSpacing,
    EUIHybridLayout,
    EUIColumnOffset,
    EUIAlignment,
    EUIResponsiveLayout
  },
  setup() {
    setCurrentPageTitle("Layout");
  }
});
</script>
