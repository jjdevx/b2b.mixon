export type DepartmentType = 'branch' | 'office' | 'shop'

export interface Department {
  id: number
  name: string
  type: DepartmentType
  createdAt: string
  updatedAt: string
  users: Array<number>
}
