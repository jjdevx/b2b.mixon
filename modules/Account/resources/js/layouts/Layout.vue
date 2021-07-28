<template>
  <KTLoader
    v-if="loaderEnabled"
    :logo="loaderLogo"
  />

  <!-- begin:: Body -->
  <div class="page d-flex flex-row flex-column-fluid">
    <!-- begin:: Aside Left -->
    <KTAside
      v-if="asideEnabled"
      :light-logo="themeLightLogo"
      :dark-logo="themeDarkLogo"
    />
    <!-- end:: Aside Left -->

    <div
      id="kt_wrapper"
      class="d-flex flex-column flex-row-fluid wrapper"
    >
      <KTHeader :title="pageTitle" />

      <!-- begin:: Content -->
      <div
        id="kt_content"
        class="content d-flex flex-column flex-column-fluid"
      >
        <!-- begin:: Content Head -->
        <KTToolbar
          v-if="subheaderDisplay && !isDocPage"
          :breadcrumbs="breadcrumbs"
          :title="pageTitle"
        />
        <!-- end:: Content Head -->

        <!-- begin:: Content Body -->
        <div class="post d-flex flex-column-fluid">
          <div
            :class="{
              'container-fluid': contentWidthFluid,
              container: !contentWidthFluid
            }"
          >
            <KTMobilePageTitle
              v-if="subheaderDisplay && !isDocPage"
              :breadcrumbs="breadcrumbs"
              :title="pageTitle"
            />
            <slot></slot>
          </div>
        </div>
        <!-- end:: Content Body -->
      </div>
      <!-- end:: Content -->
      <KTFooter />
    </div>
  </div>
  <!-- end:: Body -->
  <KTScrollTop />
  <KTExplore />
  <KTDrawerMessenger />
  <KTUserMenu />
  <KTCreateApp />
</template>

<script lang="ts">
import { defineComponent, computed, onMounted, watch } from "vue";
import { useStore } from "vuex";
import { useRoute, useRouter } from "vue-router";
import KTAside from "@/metronic/layout/aside/Aside.vue";
import KTHeader from "@/metronic/layout/header/Header.vue";
import KTFooter from "@/metronic/layout/footer/Footer.vue";
import HtmlClass from "@/metronic/core/services/LayoutService";
import KTToolbar from "@/metronic/layout/toolbar/Toolbar.vue";
import KTMobilePageTitle from "@/metronic/layout/toolbar/MobilePageTitle.vue";
import KTScrollTop from "@/metronic/layout/extras/ScrollTop.vue";
import KTUserMenu from "@/metronic/layout/header/partials/ActivityDrawer.vue";
import KTLoader from "@/metronic/components/Loader.vue";
import KTCreateApp from "@/metronic/components/modals/wizards/CreateAppModal.vue";
import KTExplore from "@/metronic/layout/extras/Explore.vue";
import KTDrawerMessenger from "@/metronic/layout/extras/DrawerMessenger.vue";
import { Actions } from "@/store/enums/StoreEnums";
import { MenuComponent } from "@/metronic/assets/ts/components";
import { removeModalBackdrop } from "@/metronic/core/helpers/dom";
import {
  toolbarDisplay,
  loaderEnabled,
  contentWidthFluid,
  loaderLogo,
  asideEnabled,
  subheaderDisplay,
  themeLightLogo,
  themeDarkLogo
} from "@/metronic/core/helpers/config";
import { isDocPage } from "@/metronic/core/helpers/documentation";

export default defineComponent({
  name: "Layout",
  components: {
    KTAside,
    KTHeader,
    KTFooter,
    KTToolbar,
    KTScrollTop,
    KTCreateApp,
    KTUserMenu,
    KTExplore,
    KTDrawerMessenger,
    KTLoader,
    KTMobilePageTitle
  },
  setup() {
    const store = useStore();
    //const route = useRoute();
    //const router = useRouter();

    // show page loading
    store.dispatch(Actions.ADD_BODY_CLASSNAME, "page-loading");

    // initialize html element classes
    HtmlClass.init();

    const pageTitle = computed(() => {
      return store.getters.pageTitle;
    });

    const breadcrumbs = computed(() => {
      return store.getters.pageBreadcrumbPath;
    });

    onMounted(() => {
      // // check if current user is authenticated
      if (store.getters.isAuthenticated) {
       // router.push({ name: "sign-in" });
      }

      // Simulate the delay page loading
      setTimeout(() => {
        // Remove page loader after some time
        store.dispatch(Actions.REMOVE_BODY_CLASSNAME, "page-loading");
      }, 500);
    });

   /* watch(
      () => route.path,
      () => {
        MenuComponent.hideDropdowns(undefined);

        // // check if current user is authenticated
        if (store.getters.isAuthenticated) {
          router.push({ name: "sign-in" });
        }

        removeModalBackdrop();
      }
    ); */

    return {
      toolbarDisplay,
      loaderEnabled,
      contentWidthFluid,
      loaderLogo,
      asideEnabled,
      subheaderDisplay,
      pageTitle,
      breadcrumbs,
      isDocPage,
      themeLightLogo,
      themeDarkLogo
    };
  }
});
</script>
