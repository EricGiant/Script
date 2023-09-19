export interface Ticket{
       id: number
       title: string
       content: string
       appointed_to_id: number
       status_id: number
       user_id: number
       category_ids: Array<number>
       created_at: string
       updated_at: string
}