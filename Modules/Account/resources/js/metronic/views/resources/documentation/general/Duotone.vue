<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>
      <ImageUsage></ImageUsage>
      <InlineUsage></InlineUsage>
      <IconColors></IconColors>
      <IconSizes></IconSizes>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/general/duotone/Overview.vue";
import ImageUsage from "@/metronic/views/resources/documentation/general/duotone/ImageUsage.vue";
import InlineUsage from "@/metronic/views/resources/documentation/general/duotone/InlineUsage.vue";
import IconColors from "@/metronic/views/resources/documentation/general/duotone/IconColors.vue";
import IconSizes from "@/metronic/views/resources/documentation/general/bootstrap-icons/IconSizes.vue";

export default defineComponent({
  name: "duotone",
  components: {
    Overview,
    ImageUsage,
    InlineUsage,
    IconColors,
    IconSizes
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Duotone");
    });
  }
});
</script>
