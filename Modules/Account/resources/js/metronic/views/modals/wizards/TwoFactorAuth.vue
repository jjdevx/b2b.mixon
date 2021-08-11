<template>
  <KTModalCard
    title="Two-factor Authentication"
    description="Click on the below buttons to launch <br/>two-factor authentication setup example."
    image="/dist/media/illustrations/hosting.png"
    button-text="Enable Two-factor Authentication"
    modal-id="kt_modal_two_factor_authentication"
  />

  <KTTwoFactorAuthModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTTwoFactorAuthModal from "@/metronic/components/modals/wizards/TwoFactorAuthModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "TwoFactorAuth",
  components: {
    KTModalCard,
    KTTwoFactorAuthModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Two Factor Auth", ["Modals", "Wizards"]);
    });
  }
});
</script>
