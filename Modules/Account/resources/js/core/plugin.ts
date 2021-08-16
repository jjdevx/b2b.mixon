import { App } from '@vue/runtime-core'
import route from '@/core/helpers/route'

export default function install(app: App) {
  app.config.globalProperties.route = route
}
