<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#nav-menu"></a>
      NavMenu
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Menu that provides navigation for your website.
    </div>
    <!--end::Block-->
  </div>
  <EUITopBar></EUITopBar>
  <EUISideBar></EUISideBar>
  <EUICollapse></EUICollapse>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUITopBar from "@/metronic/views/resources/documentation/element-ui/navigation/nav-menu/TopBar.vue";
import EUISideBar from "@/metronic/views/resources/documentation/element-ui/navigation/nav-menu/SideBar.vue";
import EUICollapse from "@/metronic/views/resources/documentation/element-ui/navigation/nav-menu/Collapse.vue";

export default defineComponent({
  name: "nav-menu",
  components: {
    EUITopBar,
    EUISideBar,
    EUICollapse
  },
  setup() {
    setCurrentPageTitle("NavMenu");
  }
});
</script>
