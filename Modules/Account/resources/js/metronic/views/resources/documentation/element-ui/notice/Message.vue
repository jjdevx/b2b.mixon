<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#message"></a>
      Message
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Used to show feedback after an activity. The difference with Notification
      is that the latter is often used to show a system level passive
      notification.
    </div>
    <!--end::Block-->
  </div>
  <EUIBasicUsage></EUIBasicUsage>
  <EUITypes></EUITypes>
  <EUIClosable></EUIClosable>
  <EUICenteredText></EUICenteredText>
  <EUIUseHTMLString></EUIUseHTMLString>
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";
import EUIBasicUsage from "@/metronic/views/resources/documentation/element-ui/notice/message/BasicUsage.vue";
import EUITypes from "@/metronic/views/resources/documentation/element-ui/notice/message/Types.vue";
import EUIClosable from "@/metronic/views/resources/documentation/element-ui/notice/message/Closable.vue";
import EUICenteredText from "@/metronic/views/resources/documentation/element-ui/notice/message/CenteredText.vue";
import EUIUseHTMLString from "@/metronic/views/resources/documentation/element-ui/notice/message/UseHTMLString.vue";

export default defineComponent({
  name: "message",
  components: {
    EUIBasicUsage,
    EUITypes,
    EUIClosable,
    EUICenteredText,
    EUIUseHTMLString
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Message");
    });
  }
});
</script>
