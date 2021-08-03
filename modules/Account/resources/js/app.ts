import {createApp, h} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {createInertiaApp, Link, usePage} from '@inertiajs/inertia-vue3'
import Layout from '@/layouts/Layout.vue'
import {InertiaProgress} from '@inertiajs/progress'

import {store, key} from './store'
import ElementPlus from 'element-plus'

import i18n from '@/metronic/core/plugins/i18n'

import {initInlineSvg} from '@/metronic/core/plugins/inline-svg'
import {initVeeValidate} from '@/metronic/core/plugins/vee-validate'
import {initApexCharts} from '@/metronic/core/plugins/apexcharts'

import '@/metronic/core/plugins/keenthemes'
import '@/metronic/core/plugins/prismjs'
import 'bootstrap'

import {flashMessages, toastMessages} from '@/helpers/flash-messages'
import {Common, Flash, Toast} from '@/types/mixon'
import {setCurrentPageTitle} from '@/metronic/core/helpers/breadcrumb'

function setTitle(title: string) {
  document.title = `${title} - Mixon`
  setCurrentPageTitle(title)
}

function initInertia() {
  const {props: {value: {common, flash, toast}}} = usePage<{ common: Common, flash: Flash, toast: Toast }>()

  store.commit('setCommon', common)

  const {meta: {title}} = common
  setTitle(title)
  if (flash) flashMessages(flash)
  if (toast) toastMessages(toast)
}

createInertiaApp({
  resolve: async (name) => {
    const {default: page} = await import(`./Pages/${name}`)
    page.layout = page.layout || Layout
    return page
  },
  setup({el, app: InertiaApp, props, plugin}) {
    const app = createApp({render: () => h(InertiaApp, props)})

    app.use(plugin).component('InertiaLink', Link)

    app.use(store, key)
    app.use(ElementPlus)

    initInlineSvg(app)
    initVeeValidate()
    initApexCharts(app)

    app.use(i18n)
    app.mount(el)

    initInertia()
    Inertia.on('success', () => initInertia())

    InertiaProgress.init()
  }
})
