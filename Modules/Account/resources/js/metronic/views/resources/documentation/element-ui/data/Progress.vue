<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#progress"></a>
      Progress
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Progress is used to show the progress of current operation, and inform the
      user the current status.
    </div>
    <!--end::Block-->
  </div>
  <EUILinearProgressBar></EUILinearProgressBar>
  <EUIInternalPercentage></EUIInternalPercentage>
  <EUICustomColor></EUICustomColor>
  <EUICircularProgressBar></EUICircularProgressBar>
  <EUIDashboardProgressBar></EUIDashboardProgressBar>
  <EUICustomizedContent></EUICustomizedContent>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUILinearProgressBar from "@/metronic/views/resources/documentation/element-ui/data/progress/LinearProgressBar.vue";
import EUIInternalPercentage from "@/metronic/views/resources/documentation/element-ui/data/progress/InternalPercentage.vue";
import EUICustomColor from "@/metronic/views/resources/documentation/element-ui/data/progress/CustomColor.vue";
import EUICircularProgressBar from "@/metronic/views/resources/documentation/element-ui/data/progress/CircularProgressBar.vue";
import EUIDashboardProgressBar from "@/metronic/views/resources/documentation/element-ui/data/progress/DashboardProgressBar.vue";
import EUICustomizedContent from "@/metronic/views/resources/documentation/element-ui/data/progress/CustomizedContent.vue";

export default defineComponent({
  name: "progress",
  components: {
    EUILinearProgressBar,
    EUIInternalPercentage,
    EUICustomColor,
    EUICircularProgressBar,
    EUIDashboardProgressBar,
    EUICustomizedContent
  },
  setup() {
    setCurrentPageTitle("Progress");
  }
});
</script>
