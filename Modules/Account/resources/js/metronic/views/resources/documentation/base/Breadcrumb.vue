<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <LineSeparator></LineSeparator>

      <DotSeparator></DotSeparator>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/breadcrumb/Overview.vue";
import LineSeparator from "@/metronic/views/resources/documentation/base/breadcrumb/LineSeparator.vue";
import DotSeparator from "@/metronic/views/resources/documentation/base/breadcrumb/DotSeparator.vue";

export default defineComponent({
  name: "breadcrumb",
  components: {
    Overview,
    LineSeparator,
    DotSeparator
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Breadcrumb");
    });
  }
});
</script>
