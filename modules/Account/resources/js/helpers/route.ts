import baseRoute, {Config} from 'ziggy-js'

declare global {
  interface Window {
    Ziggy: Config
  }
}

const route = (name: string, params = {}, absolute = false): string => {
 return baseRoute(`account.${name}`, params, absolute, window.Ziggy)
}

export default route
