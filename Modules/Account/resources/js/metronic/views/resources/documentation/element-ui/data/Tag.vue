<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#tag"></a>
      Tag
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Used for marking and selection.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUIRemovableTag></EUIRemovableTag>
  <EUIEditDynamically></EUIEditDynamically>
  <EUISizes></EUISizes>
  <EUITheme></EUITheme>
  <EUICheckableTag></EUICheckableTag>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/data/tag/BasicUsage.vue";
import EUIRemovableTag from "@/metronic/views/resources/documentation/element-ui/data/tag/RemovableTag.vue";
import EUIEditDynamically from "@/metronic/views/resources/documentation/element-ui/data/tag/EditDynamically.vue";
import EUISizes from "@/metronic/views/resources/documentation/element-ui/data/tag/Sizes.vue";
import EUITheme from "@/metronic/views/resources/documentation/element-ui/data/tag/Theme.vue";
import EUICheckableTag from "@/metronic/views/resources/documentation/element-ui/data/tag/CheckableTag.vue";

export default defineComponent({
  name: "tag",
  components: {
    EUIBasicUsage,
    EUIRemovableTag,
    EUIEditDynamically,
    EUISizes,
    EUITheme,
    EUICheckableTag
  },
  setup() {
    setCurrentPageTitle("Tag");
  }
});
</script>
