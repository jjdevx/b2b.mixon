import Swal from 'sweetalert2'
import {Flash} from '@/types/mixon'

export async function flashMessages(flash: Flash) {
  const {type, icon, timer} = flash
  let {text} = flash

  if (['warning', 'error'].includes(type)) {
    text = `Халепа! ${text}`
  }

  let intervalId!: number

  if (type === 'throttle') {
    const pattern = text
    let seconds = (timer ?? 5000) / 1000

    const replace = () => text = pattern.replace(':seconds', `${seconds}`)
    replace()

    intervalId = window.setInterval(() => {
      const content = document.querySelector('.swal2-html-container')
      if (content && seconds) {
        seconds--
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
