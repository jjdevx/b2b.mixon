<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#slider"></a>
      Slider
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Drag the slider within a fixed range.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIDiscreteValues></EUIDiscreteValues>
  <EUISliderWithInputBox></EUISliderWithInputBox>
  <EUIRangeSelection></EUIRangeSelection>
  <EUIVerticalMode></EUIVerticalMode>
  <EUIShowMarks></EUIShowMarks>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/form/slider/BasicUsage.vue";
import EUIDiscreteValues from "@/metronic/views/resources/documentation/element-ui/form/slider/DiscreteValues.vue";
import EUISliderWithInputBox from "@/metronic/views/resources/documentation/element-ui/form/slider/SliderWithInputBox.vue";
import EUIRangeSelection from "@/metronic/views/resources/documentation/element-ui/form/slider/RangeSelection.vue";
import EUIVerticalMode from "@/metronic/views/resources/documentation/element-ui/form/slider/VerticalMode.vue";
import EUIShowMarks from "@/metronic/views/resources/documentation/element-ui/form/slider/ShowMarks.vue";

export default defineComponent({
  name: "slider",
  components: {
    EUIBasicUsage,
    EUIDiscreteValues,
    EUISliderWithInputBox,
    EUIRangeSelection,
    EUIVerticalMode,
    EUIShowMarks
  },
  setup() {
    setCurrentPageTitle("Slider");
  }
});
</script>
