import type { DefineComponent } from 'vue'

declare module '*.vue' {
  const component: DefineComponent<{}, {}, never>
  export default component
}

/*
declare module '@vue/runtime-core' {
  export interface ComponentCustomProperties {

  }
}
*/

declare type Nullable<T> = {
  [P in keyof T]: T[P] | null
}
