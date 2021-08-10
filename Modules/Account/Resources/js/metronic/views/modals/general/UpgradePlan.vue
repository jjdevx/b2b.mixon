<template>
  <KTModalCard
    title="Upgrade Plan Modal Example"
    description="Click on the below buttons to launch <br/>a upgrade plan example."
    image="/dist/media/illustrations/presentation.png"
    button-text="Upgrade Plan"
    modal-id="kt_modal_upgrade_plan"
  />
  <KTUpgradePlanModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTUpgradePlanModal from "@/metronic/components/modals/general/UpgradePlanModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "UpgradePlan",
  components: {
    KTModalCard,
    KTUpgradePlanModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Upgrade Plan", ["Modals", "General"]);
    });
  }
});
</script>
