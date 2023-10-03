export interface IUser{
    id: number
    first_name: string
    last_name: string
    full_name: string
    password: string
    email: string
    is_admin: boolean
    telephone_number: string
    created_at: string
    updated_at: string
}

export class User {
    id: number;
    first_name: string;
    last_name: string;
    full_name: string;
    password: string;
    email: string;
    is_admin: boolean;
    telephone_number: string;
    created_at: string;
    updated_at: string;

    constructor() {
        this.id = NaN;
        this.first_name = '';
        this.last_name = '';
        this.full_name = '';
        this.password = '';
        this.email = '';
        this.is_admin = false;
        this.telephone_number = '';
        this.created_at = '';
        this.updated_at = '';
    }
}