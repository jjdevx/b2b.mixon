<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <Basic></Basic>

      <LightStyle></LightStyle>

      <SquareBadge></SquareBadge>

      <CircleBadge></CircleBadge>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/badges/Overview.vue";
import Basic from "@/metronic/views/resources/documentation/base/badges/Basic.vue";
import LightStyle from "@/metronic/views/resources/documentation/base/badges/LightStyle.vue";
import SquareBadge from "@/metronic/views/resources/documentation/base/badges/SquareBadge.vue";
import CircleBadge from "@/metronic/views/resources/documentation/base/badges/CircleBadge.vue";

export default defineComponent({
  name: "badges",
  components: {
    Overview,
    Basic,
    LightStyle,
    SquareBadge,
    CircleBadge
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Badges");
    });
  }
});
</script>
