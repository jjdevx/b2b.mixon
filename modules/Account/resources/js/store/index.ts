import {InjectionKey} from 'vue'
import {createStore, useStore as baseUseStore, Store} from 'vuex'
import {config} from 'vuex-module-decorators'

import AuthModule from '@/store/modules/AuthModule'
import BodyModule from '@/store/modules/BodyModule'
import BreadcrumbsModule from '@/store/modules/BreadcrumbsModule'
import ConfigModule from '@/store/modules/ConfigModule'

import {Common} from '@/types/mixon'

config.rawError = true

export interface State {
  common: Common | null
}

export const key: InjectionKey<Store<State>> = Symbol()

export const store = createStore<State>({
  state: {
    common: null,
  },
  modules: {
    AuthModule,
    BodyModule,
    BreadcrumbsModule,
    ConfigModule
  },
  mutations: {
    setCommon(state, payload) {
      state.common = payload
    }
  }
})

export default store

export function useStore() {
  return baseUseStore(key)
}
