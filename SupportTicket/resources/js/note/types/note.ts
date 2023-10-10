export interface INote {
    id: number
    content: string
    ticket_id: number
    user_id: number
    created_at: string
    updated_at: string
}

export class Note {
    id: number;
    content: string;
    ticket_id: number;
    user_id: number;
    created_at: string;
    updated_at: string;

    constructor(id: number = NaN, content: string = "", ticket_id: number = NaN, user_id: number = NaN, created_at: string = "", updated_at: string = "") {
        this.id = id;
        this.content = content;
        this.ticket_id = ticket_id;
        this.user_id = user_id;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}