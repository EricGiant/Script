export interface Ticket{
       id: number
       title: string
       content: string
    //    appointed_to_id: number
       appointed_to_user: string
       status_id: number
       status: string
       user_id: number
       user: string
       category_ids: Array<number>
       created_at: string
       updated_at: string
}