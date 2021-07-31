<template>
  <ElConfigProvider :locale="ru">
    <div class="page d-flex flex-row flex-column-fluid">
      <KTAside
        v-if="asideEnabled"
        :light-logo="themeLightLogo"
        :dark-logo="themeDarkLogo"
      />
      <div
        id="kt_wrapper"
        class="d-flex flex-column flex-row-fluid wrapper"
      >
        <KTHeader :title="pageTitle" />
        <div
          id="kt_content"
          class="content d-flex flex-column flex-column-fluid"
        >
          <KTToolbar
            v-if="subheaderDisplay"
            :breadcrumbs="breadcrumbs"
            :title="pageTitle"
          />
          <div class="post d-flex flex-column-fluid">
            <div class="container-fluid">
              <KTMobilePageTitle
                v-if="subheaderDisplay"
                :breadcrumbs="breadcrumbs"
                :title="pageTitle"
              />
              <slot />
            </div>
          </div>
        </div>
        <KTFooter />
      </div>
    </div>
    <KTScrollTop />
    <KTUserMenu />
  </ElConfigProvider>
</template>

<script lang="ts">
import {defineComponent, computed} from 'vue'
import {useStore} from '@/store'
import KTAside from '@/layouts/aside/Aside.vue'
import KTHeader from '@/layouts/header/Header.vue'
import KTFooter from '@/layouts/footer/Footer.vue'
import HtmlClass from '@/metronic/core/services/LayoutService'
import KTToolbar from '@/layouts/toolbar/Toolbar.vue'
import KTMobilePageTitle from '@/layouts/toolbar/MobilePageTitle.vue'
import KTScrollTop from '@/metronic/layout/extras/ScrollTop.vue'
import KTUserMenu from '@/metronic/layout/header/partials/ActivityDrawer.vue'
import {
  toolbarDisplay,
  loaderEnabled,
  contentWidthFluid,
  loaderLogo,
  asideEnabled,
  subheaderDisplay,
  themeLightLogo,
  themeDarkLogo
} from '@/metronic/core/helpers/config'

import {ElConfigProvider} from 'element-plus'
import ru from 'element-plus/lib/locale/lang/ru'


export default defineComponent({
  name: 'Layout',
  components: {
    KTAside,
    KTHeader,
    KTFooter,
    KTToolbar,
    KTScrollTop,
    KTUserMenu,
    KTMobilePageTitle,
    [ElConfigProvider.name]: ElConfigProvider,
  },
  setup() {
    const store = useStore()

    HtmlClass.init()

    const pageTitle = computed(() => {
      return store.getters.pageTitle
    })

    const breadcrumbs = computed(() => {
      return store.getters.pageBreadcrumbPath
    })

    /* watch(
       () => route.path,
       () => {
         MenuComponent.hideDropdowns(undefined);

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
      themeLightLogo,
      themeDarkLogo,
      ru
    }
  }
})
</script>

<style scoped>
.container-fluid {
  margin-top: 100px;
}
</style>
