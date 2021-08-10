<template>
  <KTModalCard
    title="View Users Modal Example"
    description="Click on the below buttons to launch <br/>user lists example."
    image="/dist/media/illustrations/work.png"
    button-text="View Users"
    modal-id="kt_modal_view_users"
  />

  <KTViewUsersModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTViewUsersModal from "@/metronic/components/modals/general/ViewUsersModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "ViewUsers",
  components: {
    KTModalCard,
    KTViewUsersModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("View Users", ["Modals", "General"]);
    });
  }
});
</script>
