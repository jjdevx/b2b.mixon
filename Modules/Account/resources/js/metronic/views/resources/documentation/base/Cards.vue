<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <CustomCard></CustomCard>

      <CardScroll></CardScroll>

      <FlushBorders></FlushBorders>

      <ResetSidePaddings></ResetSidePaddings>

      <CardBorder></CardBorder>

      <CardScretch></CardScretch>

      <UtilityClasses></UtilityClasses>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/cards/Overview.vue";
import CustomCard from "@/metronic/views/resources/documentation/base/cards/CustomCard.vue";
import CardScroll from "@/metronic/views/resources/documentation/base/cards/CardScroll.vue";
import FlushBorders from "@/metronic/views/resources/documentation/base/cards/FlushBorders.vue";
import ResetSidePaddings from "@/metronic/views/resources/documentation/base/cards/ResetSidePaddings.vue";
import CardBorder from "@/metronic/views/resources/documentation/base/cards/CardBorder.vue";
import CardScretch from "@/metronic/views/resources/documentation/base/cards/CardStretch.vue";
import UtilityClasses from "@/metronic/views/resources/documentation/base/cards/UtilityClasses.vue";

export default defineComponent({
  name: "cards",
  components: {
    Overview,
    CustomCard,
    CardScroll,
    FlushBorders,
    ResetSidePaddings,
    CardBorder,
    CardScretch,
    UtilityClasses
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Cards");
    });
  }
});
</script>
