<template>
  <KTModalCard
    title="New Target Modal Example"
    description="Click on the below buttons to launch <br/>a new target example."
    image="/dist/media/illustrations/statistics.png"
    button-text="Add New Target"
    modal-id="kt_modal_new_target"
  />

  <KTNewTargetModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTNewTargetModal from "@/metronic/components/modals/forms/NewTargetModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "NewTarget",
  components: {
    KTModalCard,
    KTNewTargetModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("New Target", ["Modals", "Forms"]);
    });
  }
});
</script>
