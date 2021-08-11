<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <BaseButtons></BaseButtons>

      <LightStyle></LightStyle>

      <BackgroundStyle></BackgroundStyle>

      <ColorStyle></ColorStyle>

      <ActiveStyle></ActiveStyle>

      <ActiveLightStyle></ActiveLightStyle>

      <ActiveColorStyle></ActiveColorStyle>

      <Icons></Icons>

      <SocialButtons></SocialButtons>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import Overview from "@/metronic/views/resources/documentation/base/buttons/Overview.vue";
import BaseButtons from "@/metronic/views/resources/documentation/base/buttons/BaseButtons.vue";
import LightStyle from "@/metronic/views/resources/documentation/base/buttons/LightStyle.vue";
import BackgroundStyle from "@/metronic/views/resources/documentation/base/buttons/BackgroundStyle.vue";
import ColorStyle from "@/metronic/views/resources/documentation/base/buttons/ColorStyle.vue";
import ActiveStyle from "@/metronic/views/resources/documentation/base/buttons/ActiveStyle.vue";
import ActiveLightStyle from "@/metronic/views/resources/documentation/base/buttons/ActiveLightStyle.vue";
import ActiveColorStyle from "@/metronic/views/resources/documentation/base/buttons/ActiveColorStyle.vue";
import Icons from "@/metronic/views/resources/documentation/base/buttons/Icons.vue";
import SocialButtons from "@/metronic/views/resources/documentation/base/buttons/SocialButtons.vue";

export default defineComponent({
  name: "buttons",
  components: {
    Overview,
    BaseButtons,
    LightStyle,
    BackgroundStyle,
    ColorStyle,
    ActiveStyle,
    ActiveLightStyle,
    ActiveColorStyle,
    Icons,
    SocialButtons
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Buttons");
    });
  }
});
</script>
