type saleType = 'saleSmall' | 'sale' | 'saleBig'

export type User = {
  avatar?: string
  id: number
  name: string
  surname: string
  email: string
  password: string
  company: string
  okpo: number
  country: string
  city: string
  address: string
  fax: string
  phone: string
  shippingPoint: number
  saleType: saleType
  roles: Array<number>
  categories: Array<number>
  sales: Record<number, number>
}
