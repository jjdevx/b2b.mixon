import Swal from 'sweetalert2'
import {Flash} from '@/types/mixon'

export async function flashMessages(flash: Flash) {
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
