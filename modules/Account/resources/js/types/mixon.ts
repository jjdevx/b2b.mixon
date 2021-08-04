import {SweetAlertIcon} from 'sweetalert2'

export interface Common {
  meta: {
    title: string
  },
  auth: {
    name: string
    surname: string
    email: string
    icon: string
    permissions: Array<string>
  },
  menu: Array<{ title: string, link: string, icon: string, active: boolean }>
}

export interface Flash {
  type: string,
  text: string,
  icon?: SweetAlertIcon,
  timer?: number
}

export interface Toast {
  text: string,
  icon?: SweetAlertIcon,
}
