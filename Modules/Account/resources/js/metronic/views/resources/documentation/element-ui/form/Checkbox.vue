<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#checkbox"></a>
      Checkbox
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      A group of options for multiple choices.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIDisabledState></EUIDisabledState>
  <EUICheckboxGroup></EUICheckboxGroup>
  <EUIIndeterminate></EUIIndeterminate>
  <EUIMinMaxItemsChecked></EUIMinMaxItemsChecked>
  <EUIButtonStyle></EUIButtonStyle>
  <EUIWithBorders></EUIWithBorders>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/form/checkbox/BasicUsage.vue";
import EUIDisabledState from "@/metronic/views/resources/documentation/element-ui/form/checkbox/DisabledState.vue";
import EUICheckboxGroup from "@/metronic/views/resources/documentation/element-ui/form/checkbox/CheckboxGroup.vue";
import EUIIndeterminate from "@/metronic/views/resources/documentation/element-ui/form/checkbox/Indeterminate.vue";
import EUIMinMaxItemsChecked from "@/metronic/views/resources/documentation/element-ui/form/checkbox/MinMaxItemsChecked.vue";
import EUIButtonStyle from "@/metronic/views/resources/documentation/element-ui/form/checkbox/ButtonStyle.vue";
import EUIWithBorders from "@/metronic/views/resources/documentation/element-ui/form/checkbox/WithBorders.vue";

export default defineComponent({
  name: "checkbox",
  components: {
    EUIBasicUsage,
    EUIDisabledState,
    EUICheckboxGroup,
    EUIIndeterminate,
    EUIMinMaxItemsChecked,
    EUIButtonStyle,
    EUIWithBorders
  },
  setup() {
    setCurrentPageTitle("Checkbox");
  }
});
</script>
