<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <BasicExample></BasicExample>

      <AnimatedIcon></AnimatedIcon>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/accordion/Overview.vue";
import BasicExample from "@/metronic/views/resources/documentation/base/accordion/BasicExample.vue";
import AnimatedIcon from "@/metronic/views/resources/documentation/base/accordion/AnimatedIcon.vue";

export default defineComponent({
  name: "accordion",
  components: {
    Overview,
    BasicExample,
    AnimatedIcon
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Accordion");
    });
  }
});
</script>
