declare module '*.vue' {
    import type { DefineComponent } from 'vue'
    const component: DefineComponent<{}, {}, never>
    export default component
}

declare type Nullable<T>  = {
  [P in keyof T]: T[P] | null
}
