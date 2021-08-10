<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#dropdown"></a>
      Dropdown
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Toggleable menu for displaying lists of links and actions.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUITriggeringElement></EUITriggeringElement>
  <EUIHowToTrigger></EUIHowToTrigger>
  <EUIMenuHidingBehavior></EUIMenuHidingBehavior>
  <EUICommandEvent></EUICommandEvent>
  <EUISizes></EUISizes>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/navigation/dropdown/BasicUsage.vue";
import EUITriggeringElement from "@/metronic/views/resources/documentation/element-ui/navigation/dropdown/TriggeringElement.vue";
import EUIHowToTrigger from "@/metronic/views/resources/documentation/element-ui/navigation/dropdown/HowToTrigger.vue";
import EUIMenuHidingBehavior from "@/metronic/views/resources/documentation/element-ui/navigation/dropdown/MenuHidingBehavior.vue";
import EUICommandEvent from "@/metronic/views/resources/documentation/element-ui/navigation/dropdown/CommandEvent.vue";
import EUISizes from "@/metronic/views/resources/documentation/element-ui/navigation/dropdown/Sizes.vue";

export default defineComponent({
  name: "dropdown",
  components: {
    EUIBasicUsage,
    EUITriggeringElement,
    EUIHowToTrigger,
    EUIMenuHidingBehavior,
    EUICommandEvent,
    EUISizes
  },
  setup() {
    setCurrentPageTitle("Dropdown");
  }
});
</script>
