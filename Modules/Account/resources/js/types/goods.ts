export interface Group {
  id: number
  name: string
  createdAt: string
  updatedAt: string
}

export interface Category {
  id: number
  groupId: number
  name: string
  number: number
  saleSmall: number
  sale: number
  saleBig: number
  createdAt: string
  updatedAt: string
}
