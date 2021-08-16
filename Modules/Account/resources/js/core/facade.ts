import dayjs from 'dayjs'

export { useRoute } from './helpers/route'
export { useCan } from './helpers/can'

export { Inertia } from '@inertiajs/inertia'
export { usePage } from '@inertiajs/inertia-vue3'

export { default as BaseSchema } from 'yup/lib/schema'

export { default as Swal } from 'sweetalert2'
export const formatDate = (date: string, format: string) => dayjs(date).format(format)
