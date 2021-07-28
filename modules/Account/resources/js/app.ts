import {createApp, h, App} from 'vue'
import {createInertiaApp} from '@inertiajs/inertia-vue3'

import store from './store'
import ElementPlus from 'element-plus'
import i18n from '@/metronic/core/plugins/i18n'

import MockAdapter from '@/metronic/core/mock/MockService'
import ApiService from '@/metronic/core/services/ApiService'
import {initApexCharts} from '@/metronic/core/plugins/apexcharts'
import {initInlineSvg} from '@/metronic/core/plugins/inline-svg'
import {initVeeValidate} from '@/metronic/core/plugins/vee-validate'

import '@/metronic/core/plugins/keenthemes'
import '@/metronic/core/plugins/prismjs'
import 'bootstrap'

let app: App

createInertiaApp({
  resolve: name => import(`./Pages/${name}`),
  setup({el, app: InertiaApp, props, plugin}) {
    app = createApp({render: () => h(InertiaApp, props)})
    app.use(plugin).mount(el)
  },
}).then(() => {
  app.use(store)
  app.use(ElementPlus)

  ApiService.init(app)
  MockAdapter.init(app)
  initApexCharts(app)
  initInlineSvg(app)
  initVeeValidate()

  app.use(i18n)
})


