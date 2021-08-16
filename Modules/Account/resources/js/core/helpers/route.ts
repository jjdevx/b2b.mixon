import baseRoute, { Config } from 'ziggy-js'

declare global {
  interface Window {
    Ziggy: Config
  }
}

export type RouteFunction = (name: string, params?, absolute?: boolean) => string

const route: RouteFunction = (name, params = {}, absolute = false) => {
  return baseRoute(`account.${name}`, params, absolute, window.Ziggy)
}

export function routeIncludes(name: string): boolean {
  const result = baseRoute(undefined, undefined, undefined, window.Ziggy).current()?.includes(name)
  return result === undefined ? false : result
}

export function useRoute() {
  return { route, routeIncludes }
}

export default route
