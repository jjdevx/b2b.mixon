<template>
  <KTModalsCard
    title="Share & Earn Modal Example"
    description="Click on the below buttons to launch <br/>a share & earn example."
    image="/dist/media/illustrations/coding.png"
    button-text="Share & Earn"
    modal-id="kt_modal_share_earn"
  />

  <KTShareAndEarnModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalsCard from "@/metronic/views/modals/Card.vue";
import KTShareAndEarnModal from "@/metronic/components/modals/general/ShareAndEarnModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "ShareAndEarn",
  components: {
    KTModalsCard,
    KTShareAndEarnModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Share & Earn", ["Modals", "General"]);
    });
  }
});
</script>
