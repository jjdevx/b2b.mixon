<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#cascader"></a>
      Cascader
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      If the options have a clear hierarchical structure, Cascader can be used
      to view and select them.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIDisabledOption></EUIDisabledOption>
  <EUIClearable></EUIClearable>
  <EUIDisplayOnlyTheLastLevel></EUIDisplayOnlyTheLastLevel>
  <EUIMultipleSelection></EUIMultipleSelection>
  <EUISelectAnyLevelOfOptions></EUISelectAnyLevelOfOptions>
  <EUIDynamicLoading></EUIDynamicLoading>
  <EUIFilterable></EUIFilterable>
  <EUICustomOptionContent></EUICustomOptionContent>
  <EUICascaderPanel></EUICascaderPanel>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/form/cascader/BasicUsage.vue";
import EUIDisabledOption from "@/metronic/views/resources/documentation/element-ui/form/cascader/DisabledOption.vue";
import EUIClearable from "@/metronic/views/resources/documentation/element-ui/form/cascader/Clearable.vue";
import EUIDisplayOnlyTheLastLevel from "@/metronic/views/resources/documentation/element-ui/form/cascader/DisplayOnlyTheLastLevel.vue";
import EUIMultipleSelection from "@/metronic/views/resources/documentation/element-ui/form/cascader/MultipleSelection.vue";
import EUISelectAnyLevelOfOptions from "@/metronic/views/resources/documentation/element-ui/form/cascader/SelectAnyLevelOfOptions.vue";
import EUIDynamicLoading from "@/metronic/views/resources/documentation/element-ui/form/cascader/DynamicLoading.vue";
import EUIFilterable from "@/metronic/views/resources/documentation/element-ui/form/cascader/Filterable.vue";
import EUICustomOptionContent from "@/metronic/views/resources/documentation/element-ui/form/cascader/CustomOptionContent.vue";
import EUICascaderPanel from "@/metronic/views/resources/documentation/element-ui/form/cascader/CascaderPanel.vue";

export default defineComponent({
  name: "cascader",
  components: {
    EUIBasicUsage,
    EUIDisabledOption,
    EUIClearable,
    EUIDisplayOnlyTheLastLevel,
    EUIMultipleSelection,
    EUISelectAnyLevelOfOptions,
    EUIDynamicLoading,
    EUIFilterable,
    EUICustomOptionContent,
    EUICascaderPanel
  },
  setup() {
    setCurrentPageTitle("Cascader");
  }
});
</script>
