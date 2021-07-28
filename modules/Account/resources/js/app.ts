import {createApp, h} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {createInertiaApp, Link} from '@inertiajs/inertia-vue3'
import {InertiaProgress} from '@inertiajs/progress'

import store from './store'
import ElementPlus from 'element-plus'
import i18n from '@/metronic/core/plugins/i18n'

import {initInlineSvg} from '@/metronic/core/plugins/inline-svg'
import {initVeeValidate} from '@/metronic/core/plugins/vee-validate'

import '@/metronic/core/plugins/keenthemes'
import '@/metronic/core/plugins/prismjs'
import 'bootstrap'

import {flashMessages} from '@/helpers/flash-messages'
import {initApexCharts} from '@/metronic/core/plugins/apexcharts'

createInertiaApp({
  resolve: name => import(`./Pages/${name}`),
  setup({el, app: InertiaApp, props, plugin}) {
    const app = createApp({render: () => h(InertiaApp, props)})

    app.use(plugin).component('InertiaLink', Link)

    app.use(store)
    app.use(ElementPlus)

    initInlineSvg(app)
    initVeeValidate()
    initApexCharts(app)
    InertiaProgress.init()

    app.use(i18n)
    app.mount(el)

    flashMessages(props.initialPage.props)

    Inertia.on('success', async event => flashMessages(event.detail.page.props))
  }
})
