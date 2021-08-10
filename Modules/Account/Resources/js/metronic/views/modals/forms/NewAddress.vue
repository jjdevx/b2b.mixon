<template>
  <KTModalCard
    title="New Address Modal Example"
    description="Click on the below buttons to launch <br/>a new address example."
    image="/dist/media/illustrations/statistics.png"
    button-text="Add New Address"
    modal-id="kt_modal_new_address"
  />

  <KTNewAddressModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTNewAddressModal from "@/metronic/components/modals/forms/NewAddressModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "NewAddress",
  components: {
    KTModalCard,
    KTNewAddressModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("New Address", ["Modals", "Forms"]);
    });
  }
});
</script>
