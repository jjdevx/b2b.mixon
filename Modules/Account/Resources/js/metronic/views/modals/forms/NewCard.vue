<template>
  <KTModalCard
    title="New Card Modal Example"
    description="Click on the below buttons to launch <br/>a new card example."
    image="/dist/media/illustrations/banking.png"
    button-text="Add New Card"
    modal-id="kt_modal_new_card"
  />

  <KTNewCardModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTNewCardModal from "@/metronic/components/modals/forms/NewCardModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "NewCard",
  components: {
    KTModalCard,
    KTNewCardModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("New Card", ["Modals", "Forms"]);
    });
  }
});
</script>
