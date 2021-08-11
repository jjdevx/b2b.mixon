<template>
  <EUICustomizable></EUICustomizable>
  <EUIPropAliases></EUIPropAliases>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUICustomizable from "@/metronic/views/resources/documentation/element-ui/form/transfer/Customizable.vue";
import EUIPropAliases from "@/metronic/views/resources/documentation/element-ui/form/transfer/PropAliases.vue";

export default defineComponent({
  name: "transfer",
  components: {
    EUICustomizable,
    EUIPropAliases
  },
  setup() {
    setCurrentPageTitle("Transfer");
  }
});
</script>
