export class Category {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;

    constructor(id = NaN, name = '', created_at = '', updated_at = '') {
        this.id = id;
        this.name = name;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}
