import baseRoute, {Config} from 'ziggy-js'

declare global {
  interface Window {
    Ziggy: Config
  }
}

export function routeIncludes(name: string): boolean {
  const result = baseRoute(undefined, undefined, undefined, window.Ziggy).current()?.includes(name)
  return result === undefined ? false : result
}

const route = (name: string, params = {}, absolute = false): string => {
  return baseRoute(`account.${name}`, params, absolute, window.Ziggy)
}

export default route
