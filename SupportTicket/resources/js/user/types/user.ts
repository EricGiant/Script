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

    constructor(id: number = NaN, first_name: string = "", last_name: string = "", full_name: string = "", password: string = "", email: string = "", is_admin: boolean = false, telephone_number: string = "", created_at: string = "", updated_at: string = "") {
        this.id = id
        this.first_name = first_name;
        this.last_name = last_name;
        this.full_name = full_name;
        this.password = password;
        this.email = email;
        this.is_admin = is_admin;
        this.telephone_number = telephone_number;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}