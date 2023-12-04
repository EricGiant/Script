export class UserAccount {
    id: number;
    name: string;
    email: string;
    password: string;
    created_at: string;
    updated_at: string;

    constructor(id = NaN, name = '', email = '', password = '', created_at = '', updated_at = '') {
        this.id = id;
        this.name = name;
        this.email = email;
        this.password = password;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
