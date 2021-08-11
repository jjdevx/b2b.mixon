<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <LineTabs></LineTabs>

      <LineTabs2x></LineTabs2x>

      <CardTabs></CardTabs>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/tabs/Overview.vue";
import LineTabs from "@/metronic/views/resources/documentation/base/tabs/LineTabs.vue";
import LineTabs2x from "@/metronic/views/resources/documentation/base/tabs/LineTabs2x.vue";
import CardTabs from "@/metronic/views/resources/documentation/base/tabs/CardTabs.vue";

export default defineComponent({
  name: "tabs",
  components: {
    Overview,
    LineTabs,
    LineTabs2x,
    CardTabs
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Tabs");
    });
  }
});
</script>
