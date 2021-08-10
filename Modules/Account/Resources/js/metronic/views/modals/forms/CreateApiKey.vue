<template>
  <KTModalCard
    title="Create API Key Modal Example"
    description="Click on the below buttons to launch <br/>a new API Key creation example."
    image="/dist/media/illustrations/coding.png"
    button-text="Create API Key"
    modal-id="kt_modal_create_api_key"
  />

  <KTCreateAPIKeyModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTCreateAPIKeyModal from "@/metronic/components/modals/forms/CreateAPIKeyModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "CreateApiKey",
  components: {
    KTModalCard,
    KTCreateAPIKeyModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Create API Key", ["Modals", "Forms"]);
    });
  }
});
</script>
