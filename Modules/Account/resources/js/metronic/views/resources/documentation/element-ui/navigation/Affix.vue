<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#affix"></a>
      Affix
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Fix the element to a specific visible area.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUITargetContainer></EUITargetContainer>
  <EUIFixedPosition></EUIFixedPosition>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/navigation/affix/BasicUsage.vue";
import EUITargetContainer from "@/metronic/views/resources/documentation/element-ui/navigation/affix/TargetContainer.vue";
import EUIFixedPosition from "@/metronic/views/resources/documentation/element-ui/navigation/affix/FixedPosition.vue";

export default defineComponent({
  name: "badge",
  components: {
    EUIBasicUsage,
    EUITargetContainer,
    EUIFixedPosition
  },
  setup() {
    setCurrentPageTitle("Affix");
  }
});
</script>
