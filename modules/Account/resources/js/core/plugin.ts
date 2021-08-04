import {App} from '@vue/runtime-core'
import route from '@/helpers/route'

export default function install(app: App) {
  app.config.globalProperties.route = route
}
