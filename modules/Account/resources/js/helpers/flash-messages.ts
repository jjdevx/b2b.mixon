import Swal, {SweetAlertIcon} from 'sweetalert2'
import {PageProps} from '@inertiajs/inertia/types/types'

export async function flashMessages(props: PageProps & { flash?: { type: string, text: string, icon?: SweetAlertIcon, timer?: number } }) {
  const {flash} = props
  if (flash) {
    const {type, icon} = flash
    let {text, timer} = flash

    if (['warning', 'error'].includes(type)) {
      text = `Халепа! ${text}`
    }

    let intervalId!: number

    if (type === 'throttle') {
      const pattern = text

      const replace = () => text = pattern.replace(':seconds', `${timer}`)
      replace()

      intervalId = window.setInterval(() => {
        const content = document.querySelector('.swal2-html-container')
        if (content && timer) {
          timer--
          content.innerHTML = replace()
        }
      }, 1000)
    }

    await Swal.fire({
      text,
      icon: icon ?? 'success',
      timer: timer ?? 5000,
      timerProgressBar: true
    })

    if (intervalId) {
      clearInterval(intervalId)
    }
  }
}
