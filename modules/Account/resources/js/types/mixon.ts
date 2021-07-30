import {SweetAlertIcon} from 'sweetalert2'

export interface Common {
  meta: {
    title: string
  },
  auth: {
    name: string
    email: string
  }
}

export interface Flash {
  type: string,
  text: string,
  icon?: SweetAlertIcon,
  timer?: number
}
