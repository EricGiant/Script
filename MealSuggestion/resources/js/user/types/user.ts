export class User {
    id: number;
    name: string;
    email: string;
    ingredients: {id: number; amount: number}[];
    created_at: string;
    updated_at: string;

    constructor(id = NaN, name = '', email = '', ingredients = [], created_at = '', updated_at = '') {
        this.id = id;
        this.name = name;
        this.email = email;
        this.ingredients = ingredients;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
