<template>
  <!--begin::Section-->
  <div class="pb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5" id="overview">
      <a href="#overview"></a>
      Overview
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      <b>{{ themeName }}</b> customizes the
      <a
        href="https://getbootstrap.com/docs/5.0/components/navs-tabs/#tabs"
        class="fw-bold"
        >Bootstrap Tabs</a
      >&nbsp; through the SASS variables in
      <code>src/sass/_variables.scss</code> and adds additonal options in
      <code>src/sass/_nav.scss</code>.
    </div>
    <!--end::Block-->
  </div>
  <!--end::Section-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { themeName } from "@/metronic/core/helpers/documentation";

export default defineComponent({
  name: "overview",
  components: {},
  setup() {
    return {
      themeName
    };
  }
});
</script>
