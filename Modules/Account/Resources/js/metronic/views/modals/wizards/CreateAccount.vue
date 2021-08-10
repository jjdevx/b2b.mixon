<template>
  <KTModalCard
    title="Create Account Modal Example"
    description="Click on the below buttons to launch <br/>create account modal example."
    image="/dist/media/illustrations/statistics.png"
    button-text="Create Account"
    modal-id="kt_modal_create_account"
  />

  <KTCreateAccountModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTCreateAccountModal from "@/metronic/components/modals/wizards/CreateAccountModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "CreateAccount",
  components: {
    KTModalCard,
    KTCreateAccountModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Create Account", ["Modals", "Wizards"]);
    });
  }
});
</script>
