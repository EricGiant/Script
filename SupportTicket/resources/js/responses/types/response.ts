export interface IResponse {
    id: number
    content: string
    ticket_id: number
    created_at: string
    updated_at: string
}

export class Response {
    id: number;
    content: string;
    ticket_id: number;
    created_at: string;
    updated_at: string;

    constructor(id: number = NaN, content: string = "", ticket_id: number = NaN, created_at: string = "", updated_at: string = "") {
        this.id = id;
        this.content = content;
        this.ticket_id = ticket_id;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}