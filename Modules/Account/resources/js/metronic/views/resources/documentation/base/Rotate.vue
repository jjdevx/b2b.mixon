<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <Basic></Basic>

      <Toggle></Toggle>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/rotate/Overview.vue";
import Basic from "@/metronic/views/resources/documentation/base/rotate/Basic.vue";
import Toggle from "@/metronic/views/resources/documentation/base/rotate/Toggle.vue";

export default defineComponent({
  name: "indicator",
  components: {
    Overview,
    Basic,
    Toggle
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Rotate");
    });
  }
});
</script>
