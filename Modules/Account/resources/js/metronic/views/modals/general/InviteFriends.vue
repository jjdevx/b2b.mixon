<template>
  <KTModalCard
    title="Invite Friends Modal Example"
    description="Click on the below buttons
  to launch <br />
  a friend invitation example."
    image="/dist/media/illustrations/networks.png"
    button-text="Invite Friends"
    modal-id="kt_modal_invite_friends"
  />

  <KTInviteFriendsModal />
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTModalCard from "@/metronic/views/modals/Card.vue";
import KTInviteFriendsModal from "@/metronic/components/modals/general/InviteFriendsModal.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "InviteFriends",
  components: {
    KTModalCard,
    KTInviteFriendsModal
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Invite Friends", ["Modals", "General"]);
    });
  }
});
</script>
